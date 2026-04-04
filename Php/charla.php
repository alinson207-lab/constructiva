<?php
require_once __DIR__ . '/auth.php';

corsHeaders();

// ── CONFIGURACIÓN DE USUARIO SEGÚN MÉTODO ────────────────────
$method = $_SERVER['REQUEST_METHOD'];

$user = null;

if ($method !== 'GET') {
    // Métodos protegidos: requieren autenticación
    $user = requireAuth();
} else {
    // GET público — intenta identificar usuario opcionalmente sin bloquear
    $header = $_SERVER['HTTP_AUTHORIZATION'] ?? getallheaders()['Authorization'] ?? '';
    $token  = null;

    if (preg_match('/Bearer\s+(.+)/i', $header, $m)) {
        $token = trim($m[1]);
    }
    if (!$token && !empty($_COOKIE['cv_token'])) {
        $token = $_COOKIE['cv_token'];
    }

    if ($token && $conexion) {
        $stmt = $conexion->prepare("
            SELECT u.id, u.nombre, u.apellido, u.email,
                   u.avatar_emoji, u.profesion, u.ciudad, u.rol
            FROM sesiones s
            JOIN usuarios u ON u.id = s.usuario_id
            WHERE s.token = ?
              AND s.expira_en > NOW()
              AND u.activo = 1
            LIMIT 1
        ");
        $stmt->execute([$token]);
        $user = $stmt->fetch() ?: null;
    }
}

global $conexion;

$charlaId = isset($_GET['id']) ? (int)$_GET['id'] : null;

// ── HELPERS ──────────────────────────────────────────────────

function esAdmin(): bool {
    global $user;
    return ($user['rol'] ?? '') === 'admin';
}

function esInstructor(): bool {
    global $user;
    $rol = strtolower(trim($user['rol'] ?? ''));
    return $rol === 'instructor' || $rol === 'admin';
}

function calcularEstado(string $fechaSesion, int $duracionMin): string {
    $inicio = strtotime($fechaSesion);
    $fin    = $inicio + ($duracionMin * 60);
    $ahora  = time();

    if ($ahora >= $inicio && $ahora <= $fin) return 'en_vivo';
    if ($ahora > $fin) return 'finalizada';
    return 'programada';
}

function actualizarEstado(int $id, string $fechaSesion, int $duracionMin): void {
    global $conexion;
    $estado = calcularEstado($fechaSesion, $duracionMin);

    $conexion->prepare("
        UPDATE charlas 
        SET estado = ? 
        WHERE id = ? AND estado NOT IN ('cancelada')
    ")->execute([$estado, $id]);
}

// ── GET: HISTORIAL ────────────────────────────────────────────
if ($method === 'GET' && isset($_GET['historial'])) {

    $stmt = $conexion->prepare("
        SELECT id, titulo, sesion_numero, sesion_label,
               plataforma, fecha_sesion, duracion_min,
               estado, link_grabacion
        FROM charlas
        WHERE activo = 1 AND estado = 'finalizada'
        ORDER BY fecha_sesion DESC
        LIMIT 20
    ");
    $stmt->execute();

    jsonOk(['sesiones' => $stmt->fetchAll()]);
}

// ── GET: DETALLE ──────────────────────────────────────────────
if ($method === 'GET' && $charlaId) {

    $stmt = $conexion->prepare("
        SELECT ch.*, CONCAT(u.nombre,' ',u.apellido) AS creado_por_nombre
        FROM charlas ch
        LEFT JOIN usuarios u ON u.id = ch.creado_por
        WHERE ch.id = ? AND ch.activo = 1
    ");
    $stmt->execute([$charlaId]);

    $charla = $stmt->fetch();

    if (!$charla) jsonError(404, 'Charla no encontrada');

    actualizarEstado($charla['id'], $charla['fecha_sesion'], $charla['duracion_min']);
    $charla['estado'] = calcularEstado($charla['fecha_sesion'], $charla['duracion_min']);

    jsonOk($charla);
}

// ── GET: PRÓXIMA CHARLA ───────────────────────────────────────
if ($method === 'GET') {

    $stmt = $conexion->prepare("
        SELECT ch.id, ch.titulo, ch.descripcion, ch.sesion_numero,
               ch.sesion_label, ch.plataforma, ch.fecha_sesion,
               ch.duracion_min, ch.estado, ch.link_grabacion,
               CONCAT(u.nombre,' ',u.apellido) AS instructor_nombre,
               u.avatar_emoji  AS instructor_emoji,
               u.profesion     AS instructor_profesion
        FROM charlas ch
        LEFT JOIN usuarios u ON u.id = ch.creado_por
        WHERE ch.activo = 1
          AND ch.estado NOT IN ('cancelada','finalizada')
        ORDER BY ch.fecha_sesion ASC
        LIMIT 1
    ");
    $stmt->execute();

    $proxima = $stmt->fetch();

    if ($proxima) {

        actualizarEstado($proxima['id'], $proxima['fecha_sesion'], $proxima['duracion_min']);
        $proxima['estado'] = calcularEstado($proxima['fecha_sesion'], $proxima['duracion_min']);

        $row = $conexion->prepare("SELECT link_reunion FROM charlas WHERE id = ?");
        $row->execute([$proxima['id']]);
        $proxima['link_reunion'] = $row->fetchColumn();
    }

    // Historial corto
    $hist = $conexion->prepare("
        SELECT id, titulo, sesion_numero, sesion_label,
               fecha_sesion, duracion_min, link_grabacion, estado
        FROM charlas
        WHERE activo = 1 AND estado = 'finalizada'
        ORDER BY fecha_sesion DESC
        LIMIT 3
    ");
    $hist->execute();

    jsonOk([
        'proxima'   => $proxima,
        'historial' => $hist->fetchAll(),
        'es_admin'  => esAdmin(),
    ]);
}

// ── SOLO ADMIN O INSTRUCTOR ───────────────────────────────────
if (!esInstructor()) jsonError(403, 'Acceso denegado');

// ── POST ─────────────────────────────────────────────────────
if ($method === 'POST') {

    $body = json_decode(file_get_contents('php://input'), true);

    $titulo      = trim($body['titulo'] ?? '');
    $descripcion = trim($body['descripcion'] ?? '');
    $plataforma  = $body['plataforma'] ?? '100ms';
    $link        = trim($body['link_reunion'] ?? '');
    $fechaSesion = $body['fecha_sesion'] ?? null;
    $duracion    = (int)($body['duracion_min'] ?? 90);
    $sesionNum   = (int)($body['sesion_numero'] ?? 1);
    $sesionLabel = trim($body['sesion_label'] ?? '');

    // El link solo es obligatorio si la plataforma NO es 100ms
    $linkObligatorio = ($plataforma !== '100ms');
    if (!$titulo || ($linkObligatorio && !$link) || !$fechaSesion) {
        jsonError(400, 'Datos requeridos faltantes');
    }

    // Una sesión nueva nunca debe quedar "finalizada" al crearse
    // (protección ante desfases de timezone)
    $estadoCalc = calcularEstado($fechaSesion, $duracion);
    $estado = ($estadoCalc === 'finalizada') ? 'programada' : $estadoCalc;


    $conexion->prepare("
        INSERT INTO charlas
        (titulo, descripcion, plataforma, link_reunion,
         sesion_numero, sesion_label, fecha_sesion, duracion_min,
         estado, creado_por, activo)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)
    ")->execute([
        $titulo, $descripcion, $plataforma, $link,
        $sesionNum, $sesionLabel ?: null,
        $fechaSesion, $duracion,
        $estado, $user['id']
    ]);

    jsonOk(['mensaje' => 'Charla creada', 'id' => $conexion->lastInsertId()]);
}

// ── PUT ──────────────────────────────────────────────────────
if ($method === 'PUT' && $charlaId) {

    $body = json_decode(file_get_contents('php://input'), true);

    $titulo      = trim($body['titulo'] ?? '');
    $descripcion = trim($body['descripcion'] ?? '');
    $plataforma  = $body['plataforma'] ?? '100ms';
    $link        = trim($body['link_reunion'] ?? '');
    $linkGrab    = trim($body['link_grabacion'] ?? '');
    $fechaSesion = $body['fecha_sesion'] ?? null;
    $duracion    = (int)($body['duracion_min'] ?? 90);

    // El link solo es obligatorio si la plataforma NO es 100ms
    $linkObligatorio = ($plataforma !== '100ms');
    if (!$titulo || ($linkObligatorio && !$link) || !$fechaSesion) {
        jsonError(400, 'Datos requeridos faltantes');
    }

    $estado = calcularEstado($fechaSesion, $duracion);

    $conexion->prepare("
        UPDATE charlas SET
            titulo = ?, descripcion = ?, plataforma = ?, link_reunion = ?,
            link_grabacion = ?, fecha_sesion = ?, duracion_min = ?, estado = ?
        WHERE id = ?
    ")->execute([
        $titulo, $descripcion, $plataforma, $link,
        $linkGrab ?: null, $fechaSesion, $duracion, $estado,
        $charlaId
    ]);

    jsonOk(['mensaje' => 'Actualizada']);
}

// ── DELETE ───────────────────────────────────────────────────
if ($method === 'DELETE' && $charlaId) {

    $conexion->prepare("
        UPDATE charlas 
        SET activo = 0, estado = 'cancelada'
        WHERE id = ?
    ")->execute([$charlaId]);

    jsonOk(['mensaje' => 'Cancelada']);
}

jsonError(405, 'Método no permitido');