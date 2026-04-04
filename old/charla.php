<?php
// ============================================================
//  Constructiva · Router de Charlas
//  Ubicación: /charla.php  (raíz del proyecto, junto a index)
//
//  Una sola URL para todos.
//  Detecta el rol y muestra la vista correcta automáticamente:
//    admin      → charla-admin.html
//    estudiante → charla-estudiante.html
// ============================================================

// ── Ruta corregida: auth.php está en /php/
require_once __DIR__ . '/Php/auth.php';

$user = requireAuth();

if ($user['rol'] === 'admin') {
    include __DIR__ . '/Charla-admin.php';
} else {
    include __DIR__ . '/Charla-estudiante.php';
}