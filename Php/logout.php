<?php
// ============================================================
//  POST /api/logout.php  → cierra sesión (token + cookies)
// ============================================================
require_once __DIR__ . '/conexion_bd.php';
require_once __DIR__ . '/auth.php';

corsHeaders();

$token = null;

$header = $_SERVER['HTTP_AUTHORIZATION'] ?? getallheaders()['Authorization'] ?? '';
if (preg_match('/Bearer\s+(.+)/i', $header, $m)) {
    $token = trim($m[1]);
}
if (!$token && !empty($_COOKIE['cv_token'])) {
    $token = $_COOKIE['cv_token'];
}

if ($token && $conexion) {
    $conexion->prepare("DELETE FROM sesiones WHERE token = ?")->execute([$token]);
}

/* Borrar cookies */
setcookie('cv_token',    '', ['expires' => time() - 3600, 'path' => '/', 'httponly' => true,  'samesite' => 'Lax']);
setcookie('cv_token_js', '', ['expires' => time() - 3600, 'path' => '/', 'httponly' => false, 'samesite' => 'Lax']);

jsonOk(['mensaje' => 'Sesión cerrada']);