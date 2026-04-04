<?php
// ============================================================
//  POST /api/activity.php  → renueva sesión si el usuario sigue activo
//  El JS frontend llama esto cada ~2 min cuando detecta actividad.
// ============================================================
require_once __DIR__ . '/auth.php';

corsHeaders();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonError(405, 'Método no permitido');
}

$user = requireAuth(); // renueva internamente el TTL

jsonOk(['activo' => true, 'usuario' => $user['nombre']]);