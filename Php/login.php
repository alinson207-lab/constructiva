<?php
require_once "conexion_bd.php";

$email    = trim($_POST['email']    ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($email) || empty($password)) {
    echo "<script>alert('Debe completar todos los campos'); window.location='/login';</script>";
    exit();
}

if (!$conexion) {
    echo "<script>alert('Error de conexión a la base de datos'); window.location='/login';</script>";
    exit();
}

$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email = ? AND activo = 1");
$stmt->execute([$email]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "<script>alert('No se encuentra el usuario'); window.location='/login';</script>";
    exit();
}

if (!password_verify($password, $usuario['password_hash'])) {
    echo "<script>alert('Contraseña incorrecta'); window.location='/login';</script>";
    exit();
}

/* Generar token de sesión — expira en 2 horas */
$token     = bin2hex(random_bytes(32));
$expira_en = date('Y-m-d H:i:s', strtotime('+2 hours'));
$ip        = $_SERVER['REMOTE_ADDR']     ?? null;
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? null;

/* Limpiar sesiones anteriores del usuario */
$conexion->prepare("DELETE FROM sesiones WHERE usuario_id = ?")->execute([$usuario['id']]);

$stmt = $conexion->prepare("
    INSERT INTO sesiones (usuario_id, token, ip, user_agent, expira_en)
    VALUES (?, ?, ?, ?, ?)
");
$stmt->execute([$usuario['id'], $token, $ip, $userAgent, $expira_en]);

$cookieTTL = time() + (2 * 60 * 60);

setcookie('cv_token', $token, [
    'expires'  => $cookieTTL,
    'path'     => '/',
    'httponly' => true,
    'samesite' => 'Lax',
]);

setcookie('cv_token_js', $token, [
    'expires'  => $cookieTTL,
    'path'     => '/',
    'httponly' => false,
    'samesite' => 'Lax',
]);

$userData = json_encode([
    'id'           => $usuario['id'],
    'nombre'       => $usuario['nombre'],
    'apellido'     => $usuario['apellido'],
    'email'        => $usuario['email'],
    'rol'          => $usuario['rol'],
    'avatar_emoji' => $usuario['avatar_emoji'] ?? '👤',
    'profesion'    => $usuario['profesion']    ?? '',
    'ciudad'       => $usuario['ciudad']       ?? '',
]);

// ✅ Redirigir según rol (normalizado a minúsculas)
$rol = strtolower(trim($usuario['rol']));
switch ($rol) {
    case 'admin':
        $destino = '/admin';
        break;
    case 'instructor':
        $destino = '/instructor';
        break;
    default:
        $destino = '/dashboard';
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Iniciando sesión…</title></head>
<body>
<script>
  try {
    const token   = <?= json_encode($token) ?>;
    const user    = <?= $userData ?>;
    const destino = <?= json_encode($destino) ?>;

    localStorage.setItem('cv_token', token);
    localStorage.setItem('cv_user',  JSON.stringify(user));
    localStorage.setItem('cv_last_activity', Date.now().toString());

    window.location.replace(destino);

  } catch(e) {
    window.location.replace(destino);
  }
</script>
<noscript>
  <meta http-equiv="refresh" content="0;url=<?= htmlspecialchars($destino) ?>">
</noscript>
</body>
</html>