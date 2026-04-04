<?php
// ============================================================
//  GET  /api/perfil.php        → obtener perfil
//  PUT  /api/perfil.php        → actualizar perfil
//  POST /api/perfil.php?action=password → cambiar contraseña
// ============================================================
require_once __DIR__ . '/auth.php';

corsHeaders();
$user = requireAuth();
global $conexion;

// ── GET ──────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $conexion->prepare("
        SELECT u.id, u.nombre, u.apellido, u.email,
               u.avatar_emoji, u.profesion, u.ciudad,
               u.rol,
               u.created_at,
               (SELECT COUNT(*) FROM inscripciones
                WHERE usuario_id = u.id AND estado = 'activo')     AS cursos_activos,
               (SELECT COUNT(*) FROM inscripciones
                WHERE usuario_id = u.id AND estado = 'finalizado') AS cursos_finalizados,
               (SELECT COUNT(*) FROM certificados
                WHERE usuario_id = u.id)                           AS certificados
        FROM usuarios u
        WHERE u.id = ?
    ");
    $stmt->execute([$user['id']]);
    jsonOk($stmt->fetch());
}

// ── PUT ──────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $body      = json_decode(file_get_contents('php://input'), true);
    $nombre    = trim($body['nombre']       ?? $user['nombre']);
    $apellido  = trim($body['apellido']     ?? $user['apellido']);
    $email     = trim($body['email']        ?? $user['email']);
    $profesion = trim($body['profesion']    ?? '');
    $ciudad    = trim($body['ciudad']       ?? '');
    $emoji     = trim($body['avatar_emoji'] ?? '👤');

    $check = $conexion->prepare("SELECT id FROM usuarios WHERE email = ? AND id != ?");
    $check->execute([$email, $user['id']]);
    if ($check->fetch()) jsonError(409, 'El email ya está en uso');

    $conexion->prepare("
        UPDATE usuarios
        SET nombre = ?, apellido = ?, email = ?,
            profesion = ?, ciudad = ?, avatar_emoji = ?
        WHERE id = ?
    ")->execute([$nombre, $apellido, $email, $profesion, $ciudad, $emoji, $user['id']]);

    jsonOk(['mensaje' => 'Perfil actualizado correctamente']);
}

// ── POST ?action=password ────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_GET['action'] ?? '') === 'password') {
    $body   = json_decode(file_get_contents('php://input'), true);
    $actual = $body['password_actual'] ?? '';
    $nueva  = $body['password_nueva']  ?? '';

    if (strlen($nueva) < 8) jsonError(400, 'Mínimo 8 caracteres');

    $stmt = $conexion->prepare("SELECT password_hash FROM usuarios WHERE id = ?");
    $stmt->execute([$user['id']]);
    $row = $stmt->fetch();

    if (!password_verify($actual, $row['password_hash'])) {
        jsonError(401, 'Contraseña actual incorrecta');
    }

    $hash = password_hash($nueva, PASSWORD_BCRYPT, ['cost' => 12]);
    $conexion->prepare("UPDATE usuarios SET password_hash = ? WHERE id = ?")
             ->execute([$hash, $user['id']]);

    $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
    $token = preg_match('/Bearer\s+(.+)/i', $authHeader, $m) ? trim($m[1]) : ($_COOKIE['cv_token'] ?? '');
    $conexion->prepare("DELETE FROM sesiones WHERE usuario_id = ? AND token != ?")
             ->execute([$user['id'], $token]);

    jsonOk(['mensaje' => 'Contraseña actualizada']);
}

jsonError(405, 'Método no permitido');