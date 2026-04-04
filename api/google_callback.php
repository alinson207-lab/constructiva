<?php
// ============================================================
//  CONSTRUCTIVA · Callback de Google OAuth
// ============================================================
require_once __DIR__ . '/../Php/conexion_bd.php'; // incluye config.php


session_start();

// ── VALIDAR STATE anti-CSRF ───────────────────────────────────
$state = $_GET['state'] ?? '';
if (!$state || $state !== ($_SESSION['oauth_state'] ?? '')) {
    die('<script>alert("Error de seguridad OAuth"); window.location="/loginhome.php";</script>');
}
unset($_SESSION['oauth_state']);

// ── VERIFICAR que no hubo error ───────────────────────────────
if (isset($_GET['error'])) {
    $err = htmlspecialchars($_GET['error']);
    die("<script>alert('Google rechazó el acceso: $err'); window.location='/loginhome.php';</script>");
}

$code = $_GET['code'] ?? '';
if (!$code) {
    die('<script>alert("Código de autorización no recibido"); window.location="/loginhome.php";</script>');
}

// ── INTERCAMBIAR code por access_token ───────────────────────
$tokenResponse = httpPost('https://oauth2.googleapis.com/token', [
    'code'          => $code,
    'client_id'     => GOOGLE_CLIENT_ID,
    'client_secret' => GOOGLE_CLIENT_SECRET,
    'redirect_uri'  => GOOGLE_REDIRECT_URI,
    'grant_type'    => 'authorization_code',
]);

if (!isset($tokenResponse['access_token'])) {
    error_log('Google token error: ' . json_encode($tokenResponse));
    die('<script>alert("Error al obtener token de Google"); window.location="/loginhome.php";</script>');
}

// ── OBTENER DATOS DEL USUARIO ─────────────────────────────────
$googleUser = httpGet(
    'https://www.googleapis.com/oauth2/v2/userinfo',
    $tokenResponse['access_token']
);

if (empty($googleUser['email'])) {
    die('<script>alert("No se pudo obtener el email de Google"); window.location="/loginhome.php";</script>');
}

$googleId = $googleUser['id'];
$email    = $googleUser['email'];
$nombre   = $googleUser['given_name']  ?? explode(' ', $googleUser['name'] ?? '')[0] ?? '';
$apellido = $googleUser['family_name'] ?? (explode(' ', $googleUser['name'] ?? ' ')[1] ?? '');

// ── BUSCAR O CREAR USUARIO ────────────────────────────────────
if (!$conexion) {
    die('<script>alert("Error de conexión a la base de datos"); window.location="/loginhome.php";</script>');
}

// Primero intentar por google_id (si la columna existe)
$usuario = null;

// Verificar si columna google_id existe en la tabla
$colCheck = $conexion->query("SHOW COLUMNS FROM usuarios LIKE 'google_id'");
$tieneGoogleId = $colCheck->rowCount() > 0;

if ($tieneGoogleId) {
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE google_id = ? AND activo = 1 LIMIT 1");
    $stmt->execute([$googleId]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Si no se encontró por google_id, buscar por email
if (!$usuario) {
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        if ($usuario['activo'] != 1) {
            die('<script>alert("Tu cuenta está desactivada. Contacta al administrador."); window.location="../loginhome.php";</script>');
        }
        // Vincular google_id al usuario existente
        if ($tieneGoogleId && empty($usuario['google_id'])) {
            $conexion->prepare("UPDATE usuarios SET google_id = ? WHERE id = ?")
                     ->execute([$googleId, $usuario['id']]);
        }
    }
}

// Si no existe, crear cuenta nueva
if (!$usuario) {
    $emoji   = ['👤','🧑‍💻','👷','🏗️','📐','🔧'][array_rand(['👤','🧑‍💻','👷','🏗️','📐','🔧'])];

    if ($tieneGoogleId) {
        $conexion->prepare("
            INSERT INTO usuarios (nombre, apellido, email, google_id, password_hash, rol, activo, avatar_emoji)
            VALUES (?, ?, ?, ?, '', 'estudiante', 1, ?)
        ")->execute([$nombre, $apellido, $email, $googleId, $emoji]);
    } else {
        $conexion->prepare("
            INSERT INTO usuarios (nombre, apellido, email, password_hash, rol, activo, avatar_emoji)
            VALUES (?, ?, ?, '', 'estudiante', 1, ?)
        ")->execute([$nombre, $apellido, $email, $emoji]);
    }

    $newId   = $conexion->lastInsertId();
    $stmt    = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$newId]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
}

// ── CREAR SESIÓN (igual que login.php) ───────────────────────
$token     = bin2hex(random_bytes(32));
$days      = defined('SESSION_GOOGLE_DAYS') ? SESSION_GOOGLE_DAYS : 7;
$expira_en = date('Y-m-d H:i:s', strtotime("+{$days} days"));
$ip        = $_SERVER['REMOTE_ADDR']     ?? null;
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? null;

$conexion->prepare("
    INSERT INTO sesiones (usuario_id, token, ip, user_agent, expira_en)
    VALUES (?, ?, ?, ?, ?)
")->execute([$usuario['id'], $token, $ip, $userAgent, $expira_en]);

$cookieTTL = time() + ($days * 24 * 60 * 60);

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

$rol = strtolower(trim($usuario['rol'] ?? 'estudiante'));
$destino = match($rol) {
    'admin'      => '/Admin.php',
    'instructor' => '/Instructor.php',
    default      => '/dashboard',
};
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Autenticando con Google…</title></head>
<body>
<script>
  try {
    const token = <?= json_encode($token) ?>;
    const user  = <?= $userData ?>;
    localStorage.setItem('cv_token', token);
    localStorage.setItem('cv_user',  JSON.stringify(user));
  } catch(e) {}
  window.location.href = <?= json_encode($destino) ?>;
</script>
</body>
</html>

<?php
// ── HELPERS HTTP sin librerías externas ───────────────────────

function httpPost(string $url, array $data): array {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => http_build_query($data),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_TIMEOUT        => 15,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/x-www-form-urlencoded'],
    ]);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res, true) ?? [];
}

function httpGet(string $url, string $accessToken): array {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_TIMEOUT        => 15,
        CURLOPT_HTTPHEADER     => ["Authorization: Bearer $accessToken"],
    ]);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res, true) ?? [];
}