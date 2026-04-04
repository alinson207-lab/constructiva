<?php
// ============================================================
//  GET  /Php/eventos.php              → listar eventos (público/privado)
//  POST /Php/eventos.php              → crear evento (admin/instructor)
//  PUT  /Php/eventos.php?id=X         → editar evento (admin/instructor)
//  DELETE /Php/eventos.php?id=X       → eliminar evento (admin/instructor)
// ============================================================
require_once __DIR__ . '/conexion_bd.php';
require_once __DIR__ . '/auth.php';

corsHeaders();

$method   = $_SERVER['REQUEST_METHOD'];
$eventoId = isset($_GET['id']) ? (int)$_GET['id'] : null;

// ── GET público con lógica de visibilidad ─────────────────────
if ($method === 'GET') {
    if (!$conexion) jsonError(500, 'Error de conexión');

    // Intentar identificar usuario (no obligatorio)
    $userId  = null;
    $userRol = null;
    $cursosInscritos = [];

    $token = null;
    $header = $_SERVER['HTTP_AUTHORIZATION'] ?? getallheaders()['Authorization'] ?? '';
    if (preg_match('/Bearer\s+(.+)/i', $header, $m)) $token = trim($m[1]);
    if (!$token && !empty($_COOKIE['cv_token'])) $token = $_COOKIE['cv_token'];

    if ($token) {
        $stmt = $conexion->prepare("
            SELECT u.id, u.rol FROM sesiones s
            JOIN usuarios u ON u.id = s.usuario_id
            WHERE s.token = ? AND s.expira_en > NOW() AND u.activo = 1
            LIMIT 1
        ");
        $stmt->execute([$token]);
        $u = $stmt->fetch();
        if ($u) {
            $userId  = $u['id'];
            $userRol = $u['rol'];
            // Cursos en los que está inscrito
            $ins = $conexion->prepare("SELECT curso_id FROM inscripciones WHERE usuario_id = ? AND estado = 'activo'");
            $ins->execute([$userId]);
            $cursosInscritos = array_column($ins->fetchAll(), 'curso_id');
        }
    }

    // Filtros opcionales
    $mes  = isset($_GET['mes'])  ? (int)$_GET['mes']  : null;
    $anio = isset($_GET['anio']) ? (int)$_GET['anio'] : null;

    $where  = ['e.activo = 1'];
    $params = [];

    // Filtrar por mes/año si se pide
    if ($mes && $anio) {
        $where[]  = 'MONTH(e.fecha_inicio) = ? AND YEAR(e.fecha_inicio) = ?';
        $params[] = $mes;
        $params[] = $anio;
    }

    $whereStr = implode(' AND ', $where);

    $stmt = $conexion->prepare("
        SELECT e.id, e.titulo, e.descripcion, e.tipo,
               e.fecha_inicio, e.fecha_fin, e.link,
               e.curso_id, e.es_publico, e.color,
               c.nombre AS curso_nombre, c.emoji AS curso_emoji,
               CONCAT(u.nombre,' ',u.apellido) AS creado_por_nombre
        FROM eventos e
        LEFT JOIN cursos c ON c.id = e.curso_id
        LEFT JOIN usuarios u ON u.id = e.creado_por
        WHERE $whereStr
        ORDER BY e.fecha_inicio ASC
    ");
    $stmt->execute($params);
    $todos = $stmt->fetchAll();

    // Filtrar según visibilidad
    $visibles = array_filter($todos, function($ev) use ($userId, $userRol, $cursosInscritos) {
        // Admin ve todo
        if ($userRol === 'admin' || $userRol === 'instructor') return true;
        // Evento público → siempre visible
        if ($ev['es_publico']) return true;
        // Evento de curso → solo si está inscrito
        if ($ev['curso_id'] && in_array($ev['curso_id'], $cursosInscritos)) return true;
        return false;
    });

    // Marcar si el usuario tiene acceso al link
    $resultado = array_map(function($ev) use ($userId, $userRol, $cursosInscritos) {
        $tieneAcceso = ($userRol === 'admin' || $userRol === 'instructor')
            || $ev['es_publico']
            || ($ev['curso_id'] && in_array($ev['curso_id'], $cursosInscritos));

        return [
            'id'               => $ev['id'],
            'titulo'           => $ev['titulo'],
            'descripcion'      => $ev['descripcion'],
            'tipo'             => $ev['tipo'],
            'fecha_inicio'     => $ev['fecha_inicio'],
            'fecha_fin'        => $ev['fecha_fin'],
            'link'             => $tieneAcceso ? $ev['link'] : null,
            'curso_id'         => $ev['curso_id'],
            'curso_nombre'     => $ev['curso_nombre'],
            'curso_emoji'      => $ev['curso_emoji'],
            'es_publico'       => (bool)$ev['es_publico'],
            'color'            => $ev['color'],
            'tiene_acceso'     => $tieneAcceso,
            'creado_por_nombre'=> $ev['creado_por_nombre'],
        ];
    }, array_values($visibles));

    jsonOk([
        'eventos'       => $resultado,
        'es_logueado'   => (bool)$userId,
        'cursos_inscritos' => $cursosInscritos,
    ]);
}

// ── Rutas protegidas: requieren admin o instructor ────────────
$user = requireAuth();
if (!in_array($user['rol'], ['admin', 'instructor'])) {
    jsonError(403, 'Acceso denegado. Se requiere rol de admin o instructor.');
}

// ── POST: crear evento ────────────────────────────────────────
if ($method === 'POST') {
    $body = json_decode(file_get_contents('php://input'), true);

    $titulo      = trim($body['titulo']       ?? '');
    $descripcion = trim($body['descripcion']  ?? '');
    $tipo        = $body['tipo']              ?? 'especial';
    $fechaInicio = $body['fecha_inicio']      ?? null;
    $fechaFin    = $body['fecha_fin']         ?? null;
    $link        = trim($body['link']         ?? '');
    $cursoId     = !empty($body['curso_id'])  ? (int)$body['curso_id'] : null;
    $esPublico   = isset($body['es_publico']) ? (int)(bool)$body['es_publico'] : 1;
    $color       = trim($body['color']        ?? '');

    if (!$titulo || !$fechaInicio) jsonError(400, 'titulo y fecha_inicio son requeridos');
    if (!in_array($tipo, ['live','workshop','charla','especial'])) jsonError(400, 'Tipo inválido');

    $conexion->prepare("
        INSERT INTO eventos (titulo, descripcion, tipo, fecha_inicio, fecha_fin,
                             link, curso_id, es_publico, color, creado_por)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ")->execute([$titulo, $descripcion, $tipo, $fechaInicio, $fechaFin ?: null,
                 $link ?: null, $cursoId, $esPublico, $color ?: null, $user['id']]);

    jsonOk(['mensaje' => 'Evento creado', 'id' => $conexion->lastInsertId()]);
}

// ── PUT: editar evento ────────────────────────────────────────
if ($method === 'PUT' && $eventoId) {
    $body = json_decode(file_get_contents('php://input'), true);

    $titulo      = trim($body['titulo']       ?? '');
    $descripcion = trim($body['descripcion']  ?? '');
    $tipo        = $body['tipo']              ?? 'especial';
    $fechaInicio = $body['fecha_inicio']      ?? null;
    $fechaFin    = $body['fecha_fin']         ?? null;
    $link        = trim($body['link']         ?? '');
    $cursoId     = !empty($body['curso_id'])  ? (int)$body['curso_id'] : null;
    $esPublico   = isset($body['es_publico']) ? (int)(bool)$body['es_publico'] : 1;
    $color       = trim($body['color']        ?? '');
    $activo      = isset($body['activo'])     ? (int)(bool)$body['activo'] : 1;

    if (!$titulo || !$fechaInicio) jsonError(400, 'titulo y fecha_inicio son requeridos');

    $conexion->prepare("
        UPDATE eventos SET
            titulo = ?, descripcion = ?, tipo = ?,
            fecha_inicio = ?, fecha_fin = ?, link = ?,
            curso_id = ?, es_publico = ?, color = ?, activo = ?
        WHERE id = ?
    ")->execute([$titulo, $descripcion, $tipo, $fechaInicio, $fechaFin ?: null,
                 $link ?: null, $cursoId, $esPublico, $color ?: null, $activo, $eventoId]);

    jsonOk(['mensaje' => 'Evento actualizado']);
}

// ── DELETE: eliminar evento ───────────────────────────────────
if ($method === 'DELETE' && $eventoId) {
    $conexion->prepare("UPDATE eventos SET activo = 0 WHERE id = ?")
             ->execute([$eventoId]);
    jsonOk(['mensaje' => 'Evento eliminado']);
}

jsonError(405, 'Método no permitido');