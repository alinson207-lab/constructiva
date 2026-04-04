<?php
// ============================================================
//  GET    /api/admin_cursos.php              → listar cursos
//  GET    /api/admin_cursos.php?id=1         → detalle curso
//  POST   /api/admin_cursos.php              → crear curso
//  PUT    /api/admin_cursos.php?id=1         → editar curso
//  DELETE /api/admin_cursos.php?id=1         → desactivar curso
//  POST   /api/admin_cursos.php?action=workshop      → crear workshop
//  PUT    /api/admin_cursos.php?action=workshop&id=1 → editar workshop
//  POST   /api/admin_cursos.php?action=certificado   → emitir certificado
// ============================================================
require_once __DIR__ . '/auth.php';

corsHeaders();
$admin = requireAuth();

if ($admin['rol'] !== 'admin') {
    jsonError(403, 'Acceso denegado. Se requiere rol de administrador.');
}

global $conexion;
$method = $_SERVER['REQUEST_METHOD'];
$cursoId = isset($_GET['id']) ? (int)$_GET['id'] : null;
$action  = $_GET['action'] ?? null;

// ── EMITIR certificado ────────────────────────────────────
if ($method === 'POST' && $action === 'certificado') {
    $body      = json_decode(file_get_contents('php://input'), true);
    $uId       = (int)($body['usuario_id'] ?? 0);
    $cId       = (int)($body['curso_id']   ?? 0);
    $nota      = $body['nota_final']       ?? null;

    if (!$uId || !$cId) jsonError(400, 'usuario_id y curso_id son requeridos');

    $check = $conexion->prepare("SELECT id FROM certificados WHERE usuario_id = ? AND curso_id = ?");
    $check->execute([$uId, $cId]);
    if ($check->fetch()) jsonError(409, 'Ya existe un certificado para este usuario y curso');

    $inscCheck = $conexion->prepare("SELECT id FROM inscripciones WHERE usuario_id = ? AND curso_id = ?");
    $inscCheck->execute([$uId, $cId]);
    if (!$inscCheck->fetch()) jsonError(404, 'El usuario no está inscrito en este curso');

    $codigo = 'CV-' . date('Y') . '-' . strtoupper(substr(bin2hex(random_bytes(4)), 0, 6));

    $conexion->prepare("
        INSERT INTO certificados (usuario_id, curso_id, codigo, nota_final, emitido_en)
        VALUES (?, ?, ?, ?, CURDATE())
    ")->execute([$uId, $cId, $codigo, $nota]);

    $conexion->prepare("UPDATE inscripciones SET estado = 'finalizado', fecha_finalizacion = CURDATE() WHERE usuario_id = ? AND curso_id = ?")
             ->execute([$uId, $cId]);

    jsonOk(['mensaje' => 'Certificado emitido', 'codigo' => $codigo]);
}

// ── CREAR workshop ────────────────────────────────────────
if ($method === 'POST' && $action === 'workshop') {
    $body        = json_decode(file_get_contents('php://input'), true);
    $cId         = (int)($body['curso_id']      ?? 0);
    $titulo      = trim($body['titulo']         ?? '');
    $descripcion = trim($body['descripcion']    ?? '');
    $duracion    = (int)($body['duracion_min']  ?? 90);
    $numero      = (int)($body['numero']        ?? 1);
    $orden       = (int)($body['orden']         ?? 1);

    if (!$cId || !$titulo) jsonError(400, 'curso_id y titulo son requeridos');

    $conexion->prepare("
        INSERT INTO workshops (curso_id, numero, titulo, descripcion, duracion_min, orden, activo)
        VALUES (?, ?, ?, ?, ?, ?, 1)
    ")->execute([$cId, $numero, $titulo, $descripcion, $duracion, $orden]);

    // Actualizar total_workshops del curso
    $conexion->prepare("
        UPDATE cursos SET total_workshops = (
            SELECT COUNT(*) FROM workshops WHERE curso_id = ? AND activo = 1
        ) WHERE id = ?
    ")->execute([$cId, $cId]);

    jsonOk(['mensaje' => 'Workshop creado', 'id' => $conexion->lastInsertId()]);
}

// ── EDITAR workshop ───────────────────────────────────────
if ($method === 'PUT' && $action === 'workshop') {
    $wId         = (int)($_GET['id'] ?? 0);
    $body        = json_decode(file_get_contents('php://input'), true);
    $titulo      = trim($body['titulo']        ?? '');
    $descripcion = trim($body['descripcion']   ?? '');
    $duracion    = (int)($body['duracion_min'] ?? 90);
    $orden       = (int)($body['orden']        ?? 1);
    $activo      = isset($body['activo']) ? (int)$body['activo'] : 1;

    if (!$wId || !$titulo) jsonError(400, 'id y titulo son requeridos');

    $conexion->prepare("
        UPDATE workshops SET titulo = ?, descripcion = ?, duracion_min = ?, orden = ?, activo = ?
        WHERE id = ?
    ")->execute([$titulo, $descripcion, $duracion, $orden, $activo, $wId]);

    jsonOk(['mensaje' => 'Workshop actualizado']);
}

// ── CREAR curso ───────────────────────────────────────────
if ($method === 'POST' && !$action) {
    $body           = json_decode(file_get_contents('php://input'), true);
    $nombre         = trim($body['nombre']       ?? '');
    $descripcion    = trim($body['descripcion']  ?? '');
    $emoji          = trim($body['emoji']        ?? '📚');
    $colorHex       = trim($body['color_hex']    ?? '#0d9e8e');
    $instructorId   = !empty($body['instructor_id']) ? (int)$body['instructor_id'] : null;
    $horasTotales   = (float)($body['horas_totales'] ?? 0);

    if (!$nombre) jsonError(400, 'El nombre del curso es requerido');

    $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nombre));

    // Verificar slug único
    $checkSlug = $conexion->prepare("SELECT id FROM cursos WHERE slug = ?");
    $checkSlug->execute([$slug]);
    if ($checkSlug->fetch()) {
        $slug = $slug . '-' . time();
    }

    $conexion->prepare("
        INSERT INTO cursos (slug, nombre, descripcion, emoji, color_hex, instructor_id, horas_totales, total_workshops, activo)
        VALUES (?, ?, ?, ?, ?, ?, ?, 0, 1)
    ")->execute([$slug, $nombre, $descripcion, $emoji, $colorHex, $instructorId, $horasTotales]);

    jsonOk(['mensaje' => 'Curso creado', 'id' => $conexion->lastInsertId(), 'slug' => $slug]);
}

// ── EDITAR curso ──────────────────────────────────────────
if ($method === 'PUT' && $cursoId && !$action) {
    $body         = json_decode(file_get_contents('php://input'), true);
    $nombre       = trim($body['nombre']       ?? '');
    $descripcion  = trim($body['descripcion']  ?? '');
    $emoji        = trim($body['emoji']        ?? '📚');
    $colorHex     = trim($body['color_hex']    ?? '#0d9e8e');
    $instructorId = !empty($body['instructor_id']) ? (int)$body['instructor_id'] : null;
    $horasTotales = (float)($body['horas_totales'] ?? 0);
    $activo       = isset($body['activo']) ? (int)$body['activo'] : 1;

    if (!$nombre) jsonError(400, 'El nombre es requerido');

    $conexion->prepare("
        UPDATE cursos
        SET nombre = ?, descripcion = ?, emoji = ?, color_hex = ?,
            instructor_id = ?, horas_totales = ?, activo = ?
        WHERE id = ?
    ")->execute([$nombre, $descripcion, $emoji, $colorHex, $instructorId, $horasTotales, $activo, $cursoId]);

    jsonOk(['mensaje' => 'Curso actualizado']);
}

// ── DESACTIVAR curso ──────────────────────────────────────
if ($method === 'DELETE' && $cursoId) {
    $conexion->prepare("UPDATE cursos SET activo = 0 WHERE id = ?")
             ->execute([$cursoId]);
    jsonOk(['mensaje' => 'Curso desactivado']);
}

// ── DETALLE curso ─────────────────────────────────────────
if ($method === 'GET' && $cursoId) {
    $stmt = $conexion->prepare("
        SELECT c.*, CONCAT(u.nombre,' ',u.apellido) AS instructor_nombre,
               COUNT(DISTINCT i.id) AS total_inscritos,
               COUNT(DISTINCT cert.id) AS total_certificados
        FROM cursos c
        LEFT JOIN usuarios u ON u.id = c.instructor_id
        LEFT JOIN inscripciones i ON i.curso_id = c.id
        LEFT JOIN certificados cert ON cert.curso_id = c.id
        WHERE c.id = ?
        GROUP BY c.id
    ");
    $stmt->execute([$cursoId]);
    $curso = $stmt->fetch();
    if (!$curso) jsonError(404, 'Curso no encontrado');

    $wStmt = $conexion->prepare("
        SELECT * FROM workshops WHERE curso_id = ? ORDER BY orden ASC
    ");
    $wStmt->execute([$cursoId]);
    $curso['workshops'] = $wStmt->fetchAll();

    $inscStmt = $conexion->prepare("
        SELECT i.id, i.estado, i.fecha_inscripcion,
               u.id AS usuario_id, u.nombre, u.apellido, u.email, u.avatar_emoji,
               COALESCE(ROUND(100.0 * SUM(pw.completado) / NULLIF(c.total_workshops,0)),0) AS progreso
        FROM inscripciones i
        JOIN usuarios u ON u.id = i.usuario_id
        JOIN cursos c ON c.id = i.curso_id
        LEFT JOIN workshops w ON w.curso_id = c.id
        LEFT JOIN progreso_workshop pw ON pw.workshop_id = w.id AND pw.usuario_id = i.usuario_id
        WHERE i.curso_id = ?
        GROUP BY i.id, u.id
        ORDER BY i.fecha_inscripcion DESC
    ");
    $inscStmt->execute([$cursoId]);
    $curso['inscritos'] = $inscStmt->fetchAll();

    jsonOk($curso);
}

// ── LISTAR cursos ─────────────────────────────────────────
if ($method === 'GET') {
    $stmt = $conexion->prepare("
        SELECT c.id, c.slug, c.nombre, c.descripcion, c.emoji, c.color_hex,
               c.total_workshops, c.horas_totales, c.activo, c.created_at,
               CONCAT(u.nombre,' ',u.apellido) AS instructor_nombre,
               COUNT(DISTINCT i.id)    AS total_inscritos,
               COUNT(DISTINCT cert.id) AS total_certificados,
               ROUND(AVG(CASE WHEN i.estado='activo' THEN
                   (SELECT COALESCE(SUM(pw2.completado),0)*100.0/NULLIF(c.total_workshops,0)
                    FROM progreso_workshop pw2
                    JOIN workshops w2 ON w2.id = pw2.workshop_id
                    WHERE w2.curso_id = c.id AND pw2.usuario_id = i.usuario_id)
               END),0) AS progreso_promedio
        FROM cursos c
        LEFT JOIN usuarios u ON u.id = c.instructor_id
        LEFT JOIN inscripciones i ON i.curso_id = c.id
        LEFT JOIN certificados cert ON cert.curso_id = c.id
        GROUP BY c.id
        ORDER BY c.created_at DESC
    ");
    $stmt->execute();
    $cursos = $stmt->fetchAll();

    jsonOk([
        'cursos' => $cursos,
        'stats'  => [
            'total'   => count($cursos),
            'activos' => count(array_filter($cursos, fn($c) => $c['activo'] == 1)),
        ]
    ]);
}

jsonError(405, 'Método no permitido');