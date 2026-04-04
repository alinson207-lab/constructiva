<?php
// ============================================================
//  CONSTRUCTIVA · Generador de Token para Zoom Video SDK
//  GET  /Php/zoom_token.php?topic=Clase-1&role=0
//
//  role: 0 = participante, 1 = anfitrión
// ============================================================
require_once __DIR__ . '/auth.php';

corsHeaders();

// Solo GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    jsonError(405, 'Método no permitido');
}

// Requiere sesión activa
$user = requireAuth();

// ── Parámetros ────────────────────────────────────────────────
$topic    = trim($_GET['topic'] ?? 'Clase-Constructiva');
$roleRaw  = isset($_GET['role']) ? (int)$_GET['role'] : 0;
$role     = in_array($roleRaw, [0, 1], true) ? $roleRaw : 0;

// Solo admins pueden ser anfitrión (role = 1)
if ($role === 1 && ($user['rol'] ?? '') !== 'admin') {
    $role = 0;
}

// Validar que las credenciales estén configuradas
if (!defined('ZOOM_SDK_KEY') || ZOOM_SDK_KEY === 'TU_SDK_KEY') {
    jsonError(503, 'Zoom SDK no configurado. Contacta al administrador.');
}

// ── Construir el JWT manualmente (HS256, sin librerías externas) ──
$iat = time() - 30;            // 30 s de margen por diferencia de relojes
$exp = $iat + 60 * 60;         // Válido 1 hora

$header = base64url_encode(json_encode([
    'alg' => 'HS256',
    'typ' => 'JWT',
]));

$payload = base64url_encode(json_encode([
    'app_key'   => ZOOM_SDK_KEY,
    'tpc'       => $topic,
    'role_type' => $role,
    'iat'       => $iat,
    'exp'       => $exp,
    'user_identity' => $user['email'],   // opcional: útil para trazabilidad
]));

$signature = base64url_encode(
    hash_hmac('sha256', "$header.$payload", ZOOM_SDK_SECRET, true)
);

$token = "$header.$payload.$signature";

// ── Responder ─────────────────────────────────────────────────
jsonOk([
    'token'   => $token,
    'topic'   => $topic,
    'role'    => $role,
    'expires' => $exp,
]);

// ── Helper: base64url sin padding ────────────────────────────
function base64url_encode(string $data): string {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
