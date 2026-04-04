<?php
// ============================================================
//  CONSTRUCTIVA · Cursos del Instructor
//  GET /Php/cursos_instructor.php
//  GET /Php/cursos_instructor.php?include_students=1
//
//  Accesible por: instructor, admin
//  Devuelve solo los cursos donde el usuario es instructor_id
// ============================================================
require_once __DIR__ . '/auth.php';

corsHeaders();

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    jsonError(405, 'Método no permitido');
}

$user = requireAuth();

// Solo instructor o admin pueden usar este endpoint
if (!in_array($user['rol'], ['instructor', 'admin'], true)) {
    jsonError(403, 'Acceso denegado. Se requiere rol de instructor o admin.');
}

global $conexion;

$includeStudents = isset($_GET['include_students']) && $_GET['include_students'] == '1';

// ── Obtener cursos donde este usuario es instructor ──────────
$stmt = $conexion->prepare("
    SELECT c.id, c.slug, c.nombre, c.descripcion,
           c.emoji, c.color_hex,
           c.total_workshops, c.horas_totales, c.activo,
           COUNT(DISTINCT i.id) AS total_inscritos,
           ROUND(AVG(
             CASE WHEN i.estado = 'activo' THEN
               (SELECT COALESCE(SUM(pw2.completado), 0) * 100.0 / NULLIF(c.total_workshops, 0)
                FROM progreso_workshop pw2
                JOIN workshops w2 ON w2.id = pw2.workshop_id
                WHERE w2.curso_id = c.id AND pw2.usuario_id = i.usuario_id)
             END
           ), 0) AS progreso_promedio
    FROM cursos c
    LEFT JOIN inscripciones i ON i.curso_id = c.id
    WHERE c.activo = 1
      AND c.instructor_id = ?
    GROUP BY c.id
    ORDER BY c.created_at DESC
");
$stmt->execute([$user['id']]);
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ── Si pide estudiantes también ──────────────────────────────
$estudiantes = [];

if ($includeStudents && !empty($cursos)) {
    $cursoIds = array_column($cursos, 'id');
    $placeholders = implode(',', array_fill(0, count($cursoIds), '?'));

    $stmtEst = $conexion->prepare("
        SELECT u.id, u.nombre, u.apellido, u.email, u.avatar_emoji,
               c.nombre AS curso_nombre, c.slug AS curso_slug,
               i.estado,
               COALESCE(ROUND(
                 100.0 * SUM(pw.completado) / NULLIF(c.total_workshops, 0)
               ), 0) AS progreso
        FROM inscripciones i
        JOIN usuarios u ON u.id = i.usuario_id
        JOIN cursos c ON c.id = i.curso_id
        LEFT JOIN workshops w ON w.curso_id = c.id AND w.activo = 1
        LEFT JOIN progreso_workshop pw ON pw.workshop_id = w.id AND pw.usuario_id = u.id
        WHERE i.curso_id IN ($placeholders)
          AND i.estado = 'activo'
          AND u.activo = 1
        GROUP BY i.id, u.id, c.id
        ORDER BY c.nombre, u.apellido, u.nombre
    ");
    $stmtEst->execute($cursoIds);
    $estudiantes = $stmtEst->fetchAll(PDO::FETCH_ASSOC);
}

// ── Responder ─────────────────────────────────────────────────
$response = [
    'cursos' => $cursos,
    'stats'  => [
        'total_cursos'      => count($cursos),
        'total_estudiantes' => array_sum(array_column($cursos, 'total_inscritos')),
    ],
];

if ($includeStudents) {
    $response['estudiantes'] = $estudiantes;
}

jsonOk($response);