<?php
// ============================================================
//  CONSTRUCTIVA · Inicio de autenticación con Google
//  Coloca este archivo en: /api/google_auth.php
// ============================================================

// ⚠️  session_start() DEBE ir ANTES del require para evitar
//     que cualquier output rompa la sesión.
session_start();

require_once __DIR__ . '/../Php/config.php';

// Las credenciales se leen de config.php:
// define('GOOGLE_CLIENT_ID',     '...');
// define('GOOGLE_CLIENT_SECRET', '...');
// define('GOOGLE_REDIRECT_URI',  'https://constructiva.edu.do/api/google_callback.php');

// Generar state anti-CSRF
$state = bin2hex(random_bytes(16));
$_SESSION['oauth_state'] = $state;

$params = http_build_query([
    'client_id'     => GOOGLE_CLIENT_ID,
    'redirect_uri'  => GOOGLE_REDIRECT_URI,
    'response_type' => 'code',
    'scope'         => 'openid email profile',
    'access_type'   => 'online',
    'state'         => $state,
]);

header('Location: https://accounts.google.com/o/oauth2/v2/auth?' . $params);
exit;