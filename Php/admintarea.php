<?php
// ============================================================
//  GET    /api/admin_tareas.php              → listar tareas
//  GET    /api/admin_tareas.php?id=1         → detalle + entregas
//  POST   /api/admin_tareas.php              → crear tarea
//  PUT    /api/admin_tareas.php?id=1         → editar tarea
//  DELETE /api/admin_tareas.php?id=1         → desactivar tarea
//  PUT    /api/admin_tareas.php?action=calificar → calificar entrega
// ============================================================
require_once __DIR__ . '/auth.php';

corsHeaders();
$admin = requireAuth();

if ($admin['rol'] !== 'admin') {
    jsonError(403, 'Acceso denegado. Se requiere rol de administrador.');
}

global $conexion;
$method  = $_SERVER['REQUEST_METHOD'];
$tareaId = isset($_GET['id']) ? (int)$_GET['id'] : null;
$action  = $_GET['action'] ?? null;

// ── CALIFICAR entrega ─────────────────────────────────────
if ($method === 'PUT' && $action === 'calificar') {
    $body        = json_decode(file_get_contents('php://input'), true);
    $entregaId   = (int)($body['entrega_id']  ?? 0);
    $calificacion = $body['calificacion']     ?? null;
    $feedback    = trim($body['feedback']     ?? '');

    if (!$entregaId || $calificacion === null) {
        jsonError(400, 'entrega_id y calificacion son requeridos');
    }

    if ((float)$calificacion < 0 || (float)$calificacion > 100) {
        jsonError(400, 'La calificación debe estar entre 0 y 100');
    }

    $conexion->prepare("
        UPDATE entregas
        SET calificacion = ?, feedback = ?, estado = 'calificada', calificada_en = NOW()
        WHERE id = ?
    ")->execute([$calificacion, $feedback, $entregaId]);

    jsonOk(['mensaje' => 'Entrega calificada correctamente']);
}

// ── CREAR tarea ───────────────────────────────────────────
if ($method === 'POST' && !$action) {
    $body        = json_decode(file_get_contents('php://input'), true);
    $cursoId     = (int)($body['curso_id']      ?? 0);
    $workshopId  = !empty($body['workshop_id']) ? (int)$body['workshop_id'] : null;
    $titulo      = trim($body['titulo']         ?? '');
    $descripcion = trim($body['descripcion']    ?? '');
    $tipo        = $body['tipo']                ?? 'tarea';
    $fechaLimite = $body['fecha_limite']        ?? null;
    $puntosMax   = (int)($body['puntos_max']    ?? 100);

    if (!$cursoId || !$titulo || !$fechaLimite) {
        jsonError(400, 'curso_id, titulo y fecha_limite son requeridos');
    }

    $checkCurso = $conexion->prepare("SELECT id FROM cursos WHERE id = ? AND activo = 1");
    $checkCurso->execute([$cursoId]);
    if (!$checkCurso->fetch()) jsonError(404, 'Curso no encontrado');

    $conexion->prepare("
        INSERT INTO tareas (curso_id, workshop_id, titulo, descripcion, tipo, fecha_limite, puntos_max, activo)
        VALUES (?, ?, ?, ?, ?, ?, ?, 1)
    ")->execute([$cursoId, $workshopId, $titulo, $descripcion, $tipo, $fechaLimite, $puntosMax]);

    jsonOk(['mensaje' => 'Tarea creada', 'id' => $conexion->lastInsertId()]);
}

// ── EDITAR tarea ──────────────────────────────────────────
if ($method === 'PUT' && $tareaId && !$action) {
    $body        = json_decode(file_get_contents('php://input'), true);
    $titulo      = trim($body['titulo']         ?? '');
    $descripcion = trim($body['descripcion']    ?? '');
    $tipo        = $body['tipo']                ?? 'tarea';
    $fechaLimite = $body['fecha_limite']        ?? null;
    $puntosMax   = (int)($body['puntos_max']    ?? 100);
    $activo      = isset($body['activo']) ? (int)$body['activo'] : 1;

    if (!$titulo || !$fechaLimite) jsonError(400, 'titulo y fecha_limite son requeridos');

    $conexion->prepare("
        UPDATE tareas
        SET titulo = ?, descripcion = ?, tipo = ?, fecha_limite = ?, puntos_max = ?, activo = ?
        WHERE id = ?
    ")->execute([$titulo, $descripcion, $tipo, $fechaLimite, $puntosMax, $activo, $tareaId]);

    jsonOk(['mensaje' => 'Tarea actualizada']);
}

// ── DESACTIVAR tarea ──────────────────────────────────────
if ($method === 'DELETE' && $tareaId) {
    $conexion->prepare("UPDATE tareas SET activo = 0 WHERE id = ?")
             ->execute([$tareaId]);
    jsonOk(['mensaje' => 'Tarea desactivada']);
}

// ── DETALLE tarea + entregas ──────────────────────────────
if ($method === 'GET' && $tareaId) {
    $stmt = $conexion->prepare("
        SELECT t.*, c.nombre AS curso_nombre, c.emoji AS curso_emoji,
               w.titulo AS workshop_titulo
        FROM tareas t
        JOIN cursos c ON c.id = t.curso_id
        LEFT JOIN workshops w ON w.id = t.workshop_id
        WHERE t.id = ?
    ");
    $stmt->execute([$tareaId]);
    $tarea = $stmt->fetch();
    if (!$tarea) jsonError(404, 'Tarea no encontrada');

    $entStmt = $conexion->prepare("
        SELECT e.id, e.comentario, e.calificacion, e.feedback,
               e.estado, e.entregada_en, e.calificada_en,
               u.id AS usuario_id, u.nombre, u.apellido, u.email, u.avatar_emoji
        FROM entregas e
        JOIN usuarios u ON u.id = e.usuario_id
        WHERE e.tarea_id = ?
        ORDER BY e.entregada_en DESC
    ");
    $entStmt->execute([$tareaId]);
    $tarea['entregas'] = $entStmt->fetchAll();

    // Inscritos que no han entregado
    $noEntregaron = $conexion->prepare("
        SELECT u.id, u.nombre, u.apellido, u.email, u.avatar_emoji
        FROM inscripciones i
        JOIN usuarios u ON u.id = i.usuario_id
        WHERE i.curso_id = ? AND i.estado = 'activo'
          AND u.id NOT IN (
              SELECT e2.usuario_id FROM entregas e2 WHERE e2.tarea_id = ?
          )
    ");
    $noEntregaron->execute([$tarea['curso_id'], $tareaId]);
    $tarea['sin_entregar'] = $noEntregaron->fetchAll();

    jsonOk($tarea);
}

// ── LISTAR tareas ─────────────────────────────────────────
if ($method === 'GET') {
    $cursoId = isset($_GET['curso_id']) ? (int)$_GET['curso_id'] : null;

    $where  = ['t.activo = 1'];
    $params = [];
    if ($cursoId) { $where[] = 't.curso_id = ?'; $params[] = $cursoId; }

    $whereStr = implode(' AND ', $where);

    $stmt = $conexion->prepare("
        SELECT t.id, t.titulo, t.tipo, t.fecha_limite, t.puntos_max, t.activo, t.created_at,
               c.nombre AS curso_nombre, c.emoji AS curso_emoji,
               COUNT(DISTINCT e.id)                                          AS total_entregas,
               COUNT(DISTINCT CASE WHEN e.estado='calificada' THEN e.id END) AS total_calificadas,
               COUNT(DISTINCT i.id)                                          AS total_inscritos,
               ROUND(AVG(CASE WHEN e.calificacion IS NOT NULL THEN e.calificacion END),1) AS promedio
        FROM tareas t
        JOIN cursos c ON c.id = t.curso_id
        LEFT JOIN entregas e ON e.tarea_id = t.id
        LEFT JOIN inscripciones i ON i.curso_id = t.curso_id AND i.estado = 'activo'
        WHERE $whereStr
        GROUP BY t.id
        ORDER BY t.fecha_limite ASC
    ");
    $stmt->execute($params);
    $tareas = $stmt->fetchAll();

    $pendientes = count(array_filter($tareas, fn($t) => strtotime($t['fecha_limite']) > time()));
    $vencidas   = count(array_filter($tareas, fn($t) => strtotime($t['fecha_limite']) <= time()));

    jsonOk([
        'tareas' => $tareas,
        'stats'  => [
            'total'     => count($tareas),
            'pendientes'=> $pendientes,
            'vencidas'  => $vencidas,
        ]
    ]);
}

jsonError(405, 'Método no permitido');