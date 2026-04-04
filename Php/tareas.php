<?php
// ============================================================
//  GET  /api/tareas.php         → listado de tareas
//  GET  /api/tareas.php?id=1    → detalle
//  POST /api/tareas.php?id=1    → entregar tarea
// ============================================================
require_once __DIR__ . '/auth.php';

corsHeaders();
$user = requireAuth();
global $conexion;

$tareaId = isset($_GET['id']) ? (int)$_GET['id'] : null;

// ── DETALLE ───────────────────────────────────────────────────
if ($tareaId && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $conexion->prepare("
        SELECT t.id, t.titulo, t.descripcion, t.tipo,
               t.fecha_limite, t.puntos_max,
               c.nombre AS curso_nombre, c.emoji AS curso_emoji,
               w.titulo AS workshop_titulo,
               e.id AS entrega_id, e.calificacion, e.feedback,
               e.estado AS entrega_estado,
               e.entregada_en, e.calificada_en
        FROM tareas t
        JOIN cursos c ON c.id = t.curso_id
        LEFT JOIN workshops w ON w.id = t.workshop_id
        LEFT JOIN entregas e ON e.tarea_id = t.id AND e.usuario_id = ?
        WHERE t.id = ? AND t.activo = 1
    ");
    $stmt->execute([$user['id'], $tareaId]);
    $tarea = $stmt->fetch();
    if (!$tarea) jsonError(404, 'Tarea no encontrada');

    $check = $conexion->prepare("
        SELECT id FROM inscripciones
        WHERE usuario_id = ? AND curso_id = (SELECT curso_id FROM tareas WHERE id = ?)
    ");
    $check->execute([$user['id'], $tareaId]);
    if (!$check->fetch()) jsonError(403, 'No tienes acceso a esta tarea');

    jsonOk($tarea);
}

// ── ENTREGAR ─────────────────────────────────────────────────
if ($tareaId && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $body       = json_decode(file_get_contents('php://input'), true);
    $comentario = trim($body['comentario'] ?? '');

    $stmt = $conexion->prepare("SELECT t.id, t.fecha_limite, t.curso_id FROM tareas t WHERE t.id = ? AND t.activo = 1");
    $stmt->execute([$tareaId]);
    $tarea = $stmt->fetch();
    if (!$tarea) jsonError(404, 'Tarea no encontrada');

    $check = $conexion->prepare("SELECT id FROM inscripciones WHERE usuario_id = ? AND curso_id = ?");
    $check->execute([$user['id'], $tarea['curso_id']]);
    if (!$check->fetch()) jsonError(403, 'No inscrito en este curso');

    $existing = $conexion->prepare("SELECT id, estado FROM entregas WHERE tarea_id = ? AND usuario_id = ?");
    $existing->execute([$tareaId, $user['id']]);
    $entrega = $existing->fetch();

    $ahora = date('Y-m-d H:i:s');
    $tarde = $ahora > $tarea['fecha_limite'] ? 'tarde' : 'entregada';

    if ($entrega) {
        if ($entrega['estado'] === 'calificada') jsonError(400, 'Ya fue calificada, no se puede reenviar');
        $conexion->prepare("UPDATE entregas SET comentario = ?, estado = ?, entregada_en = ? WHERE id = ?")
                 ->execute([$comentario, $tarde, $ahora, $entrega['id']]);
    } else {
        $conexion->prepare("INSERT INTO entregas (tarea_id, usuario_id, comentario, estado, entregada_en) VALUES (?,?,?,?,?)")
                 ->execute([$tareaId, $user['id'], $comentario, $tarde, $ahora]);
    }
    jsonOk(['mensaje' => 'Tarea entregada', 'estado' => $tarde]);
}

// ── LISTADO ───────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $conexion->prepare("
        SELECT
            t.id, t.titulo, t.tipo, t.fecha_limite, t.puntos_max,
            c.nombre AS curso_nombre, c.emoji AS curso_emoji,
            e.calificacion,
            e.estado AS entrega_estado,
            e.entregada_en,
            CASE
                WHEN e.estado = 'calificada'              THEN 'calificada'
                WHEN e.estado IN ('entregada','tarde')     THEN 'entregada'
                WHEN t.fecha_limite < NOW()               THEN 'vencida'
                ELSE 'pendiente'
            END AS estado_display
        FROM tareas t
        JOIN cursos c ON c.id = t.curso_id
        JOIN inscripciones i ON i.curso_id = c.id AND i.usuario_id = ?
        LEFT JOIN entregas e ON e.tarea_id = t.id AND e.usuario_id = ?
        WHERE t.activo = 1
        ORDER BY t.fecha_limite ASC
    ");
    $stmt->execute([$user['id'], $user['id']]);
    $tareas = $stmt->fetchAll();

    $pendientes  = 0; $entregadas = 0; $calificadas = 0;
    $sumaNotas   = 0; $cntNotas   = 0;
    foreach ($tareas as $t) {
        if (in_array($t['estado_display'], ['pendiente','vencida'])) $pendientes++;
        elseif ($t['estado_display'] === 'entregada') $entregadas++;
        elseif ($t['estado_display'] === 'calificada') {
            $calificadas++;
            if ($t['calificacion'] !== null) { $sumaNotas += $t['calificacion']; $cntNotas++; }
        }
    }

    jsonOk([
        'tareas' => $tareas,
        'stats'  => [
            'pendientes'  => $pendientes,
            'entregadas'  => $entregadas,
            'calificadas' => $calificadas,
            'promedio'    => $cntNotas > 0 ? round($sumaNotas / $cntNotas, 1) : null,
        ]
    ]);
}

jsonError(405, 'Método no permitido');