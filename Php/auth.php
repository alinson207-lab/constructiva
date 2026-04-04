<?php
// ============================================================
//  CONSTRUCTIVA · Helper de Autenticación
//  Sesión: 10 min de inactividad → logout automático
// ============================================================
require_once __DIR__ . '/conexion_bd.php';

/**
 * Valida el token y renueva la expiración 10 min más.
 * Si el token expiró → 401.
 */
function requireAuth(): array {
    global $conexion;
    $token = null;

    $header = $_SERVER['HTTP_AUTHORIZATION'] ?? getallheaders()['Authorization'] ?? '';
    if (preg_match('/Bearer\s+(.+)/i', $header, $m)) {
        $token = trim($m[1]);
    }

    if (!$token && !empty($_COOKIE['cv_token'])) {
        $token = $_COOKIE['cv_token'];
    }

    if (!$token) {
        jsonError(401, 'No autenticado');
    }

    if (!$conexion) jsonError(500, 'Error de conexión a la base de datos');

    $stmt = $conexion->prepare("
        SELECT u.id, u.nombre, u.apellido, u.email,
               u.avatar_emoji, u.profesion, u.ciudad, u.rol
        FROM sesiones s
        JOIN usuarios u ON u.id = s.usuario_id
        WHERE s.token = ?
          AND s.expira_en > NOW()
          AND u.activo = 1
        LIMIT 1
    ");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if (!$user) {
        // Limpiar cookie si existe
        if (!empty($_COOKIE['cv_token'])) {
            setcookie('cv_token',    '', ['expires' => time() - 1, 'path' => '/', 'httponly' => true,  'samesite' => 'Lax']);
            setcookie('cv_token_js', '', ['expires' => time() - 1, 'path' => '/', 'httponly' => false, 'samesite' => 'Lax']);
        }
        jsonError(401, 'Sesión inválida o expirada');
    }

    /* Renovar expiración: +SESSION_SLIDING_MIN minutos desde ahora (sliding session) */
    $minutos = defined('SESSION_SLIDING_MIN') ? SESSION_SLIDING_MIN : 10;
    $nuevaExpiracion = date('Y-m-d H:i:s', strtotime("+{$minutos} minutes"));
    $conexion->prepare("UPDATE sesiones SET expira_en = ? WHERE token = ?")
             ->execute([$nuevaExpiracion, $token]);

    /* Limpiar sesiones expiradas (mantenimiento silencioso) */
    $conexion->query("DELETE FROM sesiones WHERE expira_en < NOW()");

    /* Renovar cookies */
    $minutos     = defined('SESSION_SLIDING_MIN') ? SESSION_SLIDING_MIN : 10;
    $cookieTTL   = time() + ($minutos * 60);
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

    return $user;
}

function jsonError(int $code, string $msg): never {
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode(['ok' => false, 'error' => $msg]);
    exit;
}

function jsonOk(mixed $data): never {
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode(['ok' => true, 'data' => $data]);
    exit;
}

function corsHeaders(): void {
    $origin  = $_SERVER['HTTP_ORIGIN'] ?? '';
    $allowed = defined('CORS_ALLOWED_ORIGINS') ? CORS_ALLOWED_ORIGINS : [];

    if (in_array($origin, $allowed, true)) {
        header("Access-Control-Allow-Origin: $origin");
        header('Vary: Origin');
    } elseif (empty($origin)) {
        // Petición del mismo servidor (sin cabecera Origin)
        header('Access-Control-Allow-Origin: ' . (defined('SITE_URL') ? SITE_URL : ''));
    }

    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Authorization, Content-Type');
    header('Access-Control-Allow-Credentials: true');
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') exit;
}