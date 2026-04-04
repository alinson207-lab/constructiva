<?php
// ============================================================
//  GET /api/progreso.php  → stats globales del estudiante
// ============================================================
require_once __DIR__ . '/auth.php';

corsHeaders();
$user = requireAuth();
global $conexion;

if ($_SERVER['REQUEST_METHOD'] !== 'GET') jsonError(405, 'Método no permitido');

// Progreso por curso
$stmt = $conexion->prepare("
    SELECT
        c.id, c.nombre, c.emoji, c.color_hex, c.total_workshops,
        ROUND(
            100.0 * COUNT(CASE WHEN pw.completado = 1 THEN 1 END)
            / NULLIF(c.total_workshops, 0)
        , 0) AS progreso_pct,
        ROUND(COALESCE(SUM(pw.horas_vistas), 0), 1) AS horas_vistas,
        ROUND(AVG(CASE WHEN e.calificacion IS NOT NULL THEN e.calificacion END), 1) AS nota_promedio
    FROM inscripciones i
    JOIN cursos c ON c.id = i.curso_id AND c.activo = 1
    LEFT JOIN workshops w ON w.curso_id = c.id AND w.activo = 1
    LEFT JOIN progreso_workshop pw ON pw.workshop_id = w.id AND pw.usuario_id = i.usuario_id
    LEFT JOIN tareas t ON t.curso_id = c.id
    LEFT JOIN entregas e ON e.tarea_id = t.id AND e.usuario_id = i.usuario_id
    WHERE i.usuario_id = ?
    GROUP BY c.id, c.nombre, c.emoji, c.color_hex, c.total_workshops
");
$stmt->execute([$user['id']]);
$cursos = $stmt->fetchAll();

$progresoGlobal = count($cursos) > 0
    ? round(array_sum(array_column($cursos, 'progreso_pct')) / count($cursos)) : 0;
$horasTotales = round(array_sum(array_column($cursos, 'horas_vistas')), 1);
$notas = array_filter(array_column($cursos, 'nota_promedio'));
$promedioGlobal = count($notas) > 0 ? round(array_sum($notas) / count($notas), 1) : null;

// Actividades completadas
$stmtAct = $conexion->prepare("
    SELECT COUNT(*) FROM entregas
    WHERE usuario_id = ? AND estado IN ('entregada','calificada','tarde')
");
$stmtAct->execute([$user['id']]);
$actividades = (int)$stmtAct->fetchColumn();

// Certificados
$stmtCert = $conexion->prepare("
    SELECT cert.id, cert.codigo, cert.nota_final, cert.emitido_en,
           c.nombre AS curso_nombre, c.emoji
    FROM certificados cert
    JOIN cursos c ON c.id = cert.curso_id
    WHERE cert.usuario_id = ?
    ORDER BY cert.emitido_en DESC
");
$stmtCert->execute([$user['id']]);
$certificados = $stmtCert->fetchAll();

// Historial de calificaciones
$stmtHist = $conexion->prepare("
    SELECT t.titulo, t.tipo, c.nombre AS curso_nombre, c.emoji,
           e.calificacion, e.entregada_en, e.calificada_en
    FROM entregas e
    JOIN tareas t ON t.id = e.tarea_id
    JOIN cursos c ON c.id = t.curso_id
    WHERE e.usuario_id = ? AND e.calificacion IS NOT NULL
    ORDER BY e.calificada_en DESC
    LIMIT 20
");
$stmtHist->execute([$user['id']]);
$historial = $stmtHist->fetchAll();

jsonOk([
    'stats' => [
        'progreso_global'        => $progresoGlobal,
        'horas_totales'          => $horasTotales,
        'promedio_global'        => $promedioGlobal,
        'actividades_completadas'=> $actividades,
        'total_certificados'     => count($certificados),
    ],
    'cursos'       => $cursos,
    'certificados' => $certificados,
    'historial'    => $historial,
]);