<?php
// ============================================================
//  GET    /api/admin_usuarios.php              → listar usuarios
//  GET    /api/admin_usuarios.php?id=1         → detalle usuario
//  POST   /api/admin_usuarios.php              → crear usuario
//  PUT    /api/admin_usuarios.php?id=1         → editar usuario
//  DELETE /api/admin_usuarios.php?id=1         → desactivar usuario
//  POST   /api/admin_usuarios.php?action=inscribir → inscribir a curso
//  PUT    /api/admin_usuarios.php?action=inscripcion → actualizar inscripción
// ============================================================
require_once __DIR__ . '/auth.php';

corsHeaders();
$admin = requireAuth();

if ($admin['rol'] !== 'admin') {
    jsonError(403, 'Acceso denegado. Se requiere rol de administrador.');
}

global $conexion;
$method = $_SERVER['REQUEST_METHOD'];
$userId = isset($_GET['id']) ? (int)$_GET['id'] : null;
$action = $_GET['action'] ?? null;

// ── INSCRIBIR usuario a curso ─────────────────────────────
if ($method === 'POST' && $action === 'inscribir') {
    $body    = json_decode(file_get_contents('php://input'), true);
    $uId     = (int)($body['usuario_id'] ?? 0);
    $cId     = (int)($body['curso_id']   ?? 0);
    $estado  = $body['estado'] ?? 'activo';

    if (!$uId || !$cId) jsonError(400, 'usuario_id y curso_id son requeridos');

    $check = $conexion->prepare("SELECT id FROM inscripciones WHERE usuario_id = ? AND curso_id = ?");
    $check->execute([$uId, $cId]);
    if ($check->fetch()) jsonError(409, 'El usuario ya está inscrito en este curso');

    $conexion->prepare("
        INSERT INTO inscripciones (usuario_id, curso_id, estado, fecha_inscripcion)
        VALUES (?, ?, ?, CURDATE())
    ")->execute([$uId, $cId, $estado]);

    jsonOk(['mensaje' => 'Usuario inscrito correctamente']);
}

// ── ACTUALIZAR inscripción ────────────────────────────────
if ($method === 'PUT' && $action === 'inscripcion') {
    $body   = json_decode(file_get_contents('php://input'), true);
    $inscId = (int)($body['inscripcion_id'] ?? 0);
    $estado = $body['estado'] ?? 'activo';

    if (!$inscId) jsonError(400, 'inscripcion_id es requerido');

    $conexion->prepare("UPDATE inscripciones SET estado = ? WHERE id = ?")
             ->execute([$estado, $inscId]);

    jsonOk(['mensaje' => 'Inscripción actualizada']);
}

// ── CREAR usuario ─────────────────────────────────────────
if ($method === 'POST' && !$action) {
    $body     = json_decode(file_get_contents('php://input'), true);
    $nombre   = trim($body['nombre']   ?? '');
    $apellido = trim($body['apellido'] ?? '');
    $email    = trim($body['email']    ?? '');
    $password = $body['password']      ?? '';
    $rol      = $body['rol']           ?? 'estudiante';

    if (!$nombre || !$apellido || !$email || !$password) {
        jsonError(400, 'Nombre, apellido, email y password son requeridos');
    }

    $check = $conexion->prepare("SELECT id FROM usuarios WHERE email = ?");
    $check->execute([$email]);
    if ($check->fetch()) jsonError(409, 'El email ya está registrado');

    $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

    $conexion->prepare("
        INSERT INTO usuarios (nombre, apellido, email, password_hash, rol, activo)
        VALUES (?, ?, ?, ?, ?, 1)
    ")->execute([$nombre, $apellido, $email, $hash, $rol]);

    $newId = $conexion->lastInsertId();

    // Si viene curso_id, inscribir directamente
    if (!empty($body['curso_id'])) {
        $conexion->prepare("
            INSERT INTO inscripciones (usuario_id, curso_id, estado, fecha_inscripcion)
            VALUES (?, ?, 'activo', CURDATE())
        ")->execute([$newId, (int)$body['curso_id']]);
    }

    jsonOk(['mensaje' => 'Usuario creado', 'id' => $newId]);
}

// ── EDITAR usuario ────────────────────────────────────────
if ($method === 'PUT' && $userId && !$action) {
    $body     = json_decode(file_get_contents('php://input'), true);
    $nombre   = trim($body['nombre']       ?? '');
    $apellido = trim($body['apellido']     ?? '');
    $email    = trim($body['email']        ?? '');
    $rol      = $body['rol']               ?? 'estudiante';
    $activo   = isset($body['activo']) ? (int)$body['activo'] : 1;

    if (!$nombre || !$apellido || !$email) {
        jsonError(400, 'Nombre, apellido y email son requeridos');
    }

    $check = $conexion->prepare("SELECT id FROM usuarios WHERE email = ? AND id != ?");
    $check->execute([$email, $userId]);
    if ($check->fetch()) jsonError(409, 'El email ya está en uso por otro usuario');

    $conexion->prepare("
        UPDATE usuarios
        SET nombre = ?, apellido = ?, email = ?, rol = ?, activo = ?
        WHERE id = ?
    ")->execute([$nombre, $apellido, $email, $rol, $activo, $userId]);

    // Cambiar contraseña si viene
    if (!empty($body['password'])) {
        $hash = password_hash($body['password'], PASSWORD_BCRYPT, ['cost' => 12]);
        $conexion->prepare("UPDATE usuarios SET password_hash = ? WHERE id = ?")
                 ->execute([$hash, $userId]);
    }

    jsonOk(['mensaje' => 'Usuario actualizado']);
}

// ── DESACTIVAR usuario ────────────────────────────────────
if ($method === 'DELETE' && $userId) {
    if ($userId === (int)$admin['id']) jsonError(400, 'No puedes desactivarte a ti mismo');

    $conexion->prepare("UPDATE usuarios SET activo = 0 WHERE id = ?")
             ->execute([$userId]);

    jsonOk(['mensaje' => 'Usuario desactivado']);
}

// ── DETALLE usuario ───────────────────────────────────────
if ($method === 'GET' && $userId) {
    $stmt = $conexion->prepare("
        SELECT u.id, u.nombre, u.apellido, u.email, u.rol, u.activo,
               u.avatar_emoji, u.profesion, u.ciudad, u.created_at,
               COUNT(DISTINCT i.id) AS total_inscripciones
        FROM usuarios u
        LEFT JOIN inscripciones i ON i.usuario_id = u.id
        WHERE u.id = ?
        GROUP BY u.id
    ");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    if (!$user) jsonError(404, 'Usuario no encontrado');

    $inscStmt = $conexion->prepare("
        SELECT i.id, i.estado, i.fecha_inscripcion, i.fecha_finalizacion,
               c.id AS curso_id, c.nombre AS curso_nombre, c.emoji,
               COALESCE(ROUND(100.0 * SUM(pw.completado) / NULLIF(c.total_workshops,0)),0) AS progreso
        FROM inscripciones i
        JOIN cursos c ON c.id = i.curso_id
        LEFT JOIN workshops w ON w.curso_id = c.id
        LEFT JOIN progreso_workshop pw ON pw.workshop_id = w.id AND pw.usuario_id = i.usuario_id
        WHERE i.usuario_id = ?
        GROUP BY i.id, c.id
        ORDER BY i.fecha_inscripcion DESC
    ");
    $inscStmt->execute([$userId]);
    $user['inscripciones'] = $inscStmt->fetchAll();

    jsonOk($user);
}

// ── LISTAR usuarios ───────────────────────────────────────
if ($method === 'GET') {
    $rol    = $_GET['rol']    ?? null;
    $activo = $_GET['activo'] ?? null;
    $search = $_GET['q']      ?? null;

    $where = ['1=1'];
    $params = [];

    if ($rol)    { $where[] = 'u.rol = ?';    $params[] = $rol; }
    if ($activo !== null) { $where[] = 'u.activo = ?'; $params[] = (int)$activo; }
    if ($search) {
        $where[] = '(u.nombre LIKE ? OR u.apellido LIKE ? OR u.email LIKE ?)';
        $like = '%' . $search . '%';
        $params[] = $like; $params[] = $like; $params[] = $like;
    }

    $whereStr = implode(' AND ', $where);

    $stmt = $conexion->prepare("
        SELECT u.id, u.nombre, u.apellido, u.email, u.rol, u.activo,
               u.avatar_emoji, u.profesion, u.ciudad, u.created_at,
               COUNT(DISTINCT i.id) AS inscripciones_activas,
               COUNT(DISTINCT cert.id) AS certificados
        FROM usuarios u
        LEFT JOIN inscripciones i ON i.usuario_id = u.id AND i.estado = 'activo'
        LEFT JOIN certificados cert ON cert.usuario_id = u.id
        WHERE $whereStr
        GROUP BY u.id
        ORDER BY u.created_at DESC
    ");
    $stmt->execute($params);
    $usuarios = $stmt->fetchAll();

    $totalEstudiantes = count(array_filter($usuarios, fn($u) => $u['rol'] === 'estudiante'));
    $totalAdmins      = count(array_filter($usuarios, fn($u) => $u['rol'] === 'admin'));
    $totalActivos     = count(array_filter($usuarios, fn($u) => $u['activo'] == 1));

    jsonOk([
        'usuarios' => $usuarios,
        'stats'    => [
            'total'      => count($usuarios),
            'estudiantes'=> $totalEstudiantes,
            'admins'     => $totalAdmins,
            'activos'    => $totalActivos,
        ]
    ]);
}

jsonError(405, 'Método no permitido');