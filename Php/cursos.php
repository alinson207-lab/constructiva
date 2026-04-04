<?php
// ============================================================
//  GET /api/cursos.php          → cursos inscritos
//  GET /api/cursos.php?id=1     → detalle + workshops + progreso
// ============================================================
require_once __DIR__ . '/auth.php';

corsHeaders();
$user = requireAuth();
global $conexion;

if ($_SERVER['REQUEST_METHOD'] !== 'GET') jsonError(405, 'Método no permitido');

$cursoId = isset($_GET['id']) ? (int)$_GET['id'] : null;

// ── DETALLE ───────────────────────────────────────────────────
if ($cursoId) {
    $check = $conexion->prepare("
        SELECT id FROM inscripciones
        WHERE usuario_id = ? AND curso_id = ? AND estado != 'suspendido'
    ");
    $check->execute([$user['id'], $cursoId]);
    if (!$check->fetch()) jsonError(403, 'No inscrito en este curso');

    $stmt = $conexion->prepare("
        SELECT c.id, c.slug, c.nombre, c.descripcion, c.emoji,
               c.color_hex, c.total_workshops, c.horas_totales,
               CONCAT(u.nombre,' ',u.apellido) AS instructor
        FROM cursos c
        LEFT JOIN usuarios u ON u.id = c.instructor_id
        WHERE c.id = ? AND c.activo = 1
    ");
    $stmt->execute([$cursoId]);
    $curso = $stmt->fetch();
    if (!$curso) jsonError(404, 'Curso no encontrado');

    $stmt2 = $conexion->prepare("
        SELECT w.id, w.numero, w.titulo, w.duracion_min,
               COALESCE(pw.completado,   0) AS completado,
               COALESCE(pw.porcentaje,   0) AS porcentaje,
               COALESCE(pw.horas_vistas, 0) AS horas_vistas
        FROM workshops w
        LEFT JOIN progreso_workshop pw
               ON pw.workshop_id = w.id AND pw.usuario_id = ?
        WHERE w.curso_id = ? AND w.activo = 1
        ORDER BY w.orden
    ");
    $stmt2->execute([$user['id'], $cursoId]);
    $workshops = $stmt2->fetchAll();

    $totalW      = count($workshops);
    $completados = array_sum(array_column($workshops, 'completado'));
    $progresoPct = $totalW > 0 ? round(($completados / $totalW) * 100) : 0;
    $horasVistas = array_sum(array_column($workshops, 'horas_vistas'));

    $curso['workshops']    = $workshops;
    $curso['progreso_pct'] = $progresoPct;
    $curso['horas_vistas'] = round($horasVistas, 1);

    jsonOk($curso);
}

// ── LISTADO ───────────────────────────────────────────────────
$stmt = $conexion->prepare("
    SELECT
        c.id, c.slug, c.nombre, c.descripcion,
        c.emoji, c.color_hex, c.total_workshops, c.horas_totales,
        i.estado AS inscripcion_estado,
        i.fecha_inscripcion,
        ROUND(
            100.0 * COUNT(CASE WHEN pw.completado = 1 THEN 1 END)
            / NULLIF(c.total_workshops, 0)
        , 0) AS progreso_pct,
        ROUND(COALESCE(SUM(pw.horas_vistas), 0), 1) AS horas_vistas,
        cert.codigo    AS certificado_codigo,
        cert.nota_final AS certificado_nota,
        cert.emitido_en AS certificado_fecha
    FROM inscripciones i
    JOIN cursos c ON c.id = i.curso_id AND c.activo = 1
    LEFT JOIN workshops w ON w.curso_id = c.id AND w.activo = 1
    LEFT JOIN progreso_workshop pw
           ON pw.workshop_id = w.id AND pw.usuario_id = i.usuario_id
    LEFT JOIN certificados cert
           ON cert.curso_id = c.id AND cert.usuario_id = i.usuario_id
    WHERE i.usuario_id = ?
    GROUP BY c.id, i.estado, i.fecha_inscripcion,
             cert.codigo, cert.nota_final, cert.emitido_en
    ORDER BY i.fecha_inscripcion DESC
");
$stmt->execute([$user['id']]);
$cursos = $stmt->fetchAll();

$total      = count($cursos);
$activos    = count(array_filter($cursos, fn($c) => $c['inscripcion_estado'] === 'activo'));
$progresoG  = $total > 0 ? round(array_sum(array_column($cursos, 'progreso_pct')) / $total) : 0;
$horasTotal = round(array_sum(array_column($cursos, 'horas_vistas')), 1);

jsonOk([
    'cursos' => $cursos,
    'stats'  => [
        'total'           => $total,
        'activos'         => $activos,
        'finalizados'     => $total - $activos,
        'progreso_global' => $progresoG,
        'horas_totales'   => $horasTotal,
    ]
]);