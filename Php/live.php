<?php
// ============================================================
//  GET  /Php/live.php   → obtener configuración del live (público)
//  PUT  /Php/live.php   → actualizar configuración (solo admin)
// ============================================================
require_once __DIR__ . '/conexion_bd.php';
require_once __DIR__ . '/auth.php';

corsHeaders();

$method = $_SERVER['REQUEST_METHOD'];

// ── GET público ───────────────────────────────────────────────
if ($method === 'GET') {
    if (!$conexion) jsonError(500, 'Error de conexión');

    $stmt = $conexion->prepare("SELECT youtube_id, titulo, descripcion, activo, mostrar_chat FROM live_config LIMIT 1");
    $stmt->execute();
    $config = $stmt->fetch();

    if (!$config) {
        jsonOk([
            'youtube_id'   => null,
            'titulo'       => 'Live Constructiva',
            'descripcion'  => '',
            'activo'       => false,
            'mostrar_chat' => true,
        ]);
        return;
    }

    jsonOk([
        'youtube_id'   => $config['youtube_id'],
        'titulo'       => $config['titulo'],
        'descripcion'  => $config['descripcion'],
        'activo'       => (bool)$config['activo'],
        'mostrar_chat' => (bool)$config['mostrar_chat'],
    ]);
}

// ── PUT solo admin ────────────────────────────────────────────
if ($method === 'PUT') {
    $admin = requireAuth();
    if ($admin['rol'] !== 'admin') jsonError(403, 'Acceso denegado');

    $body        = json_decode(file_get_contents('php://input'), true);
    $youtubeId   = trim($body['youtube_id']  ?? '');
    $titulo      = trim($body['titulo']      ?? 'Live Constructiva');
    $descripcion = trim($body['descripcion'] ?? '');
    $activo      = isset($body['activo'])      ? (int)(bool)$body['activo']      : 0;
    $mostrarChat = isset($body['mostrar_chat']) ? (int)(bool)$body['mostrar_chat'] : 1;

    // Extraer ID si pegaron URL completa de YouTube
    if ($youtubeId) {
        // Soporta: youtu.be/ID, youtube.com/watch?v=ID, youtube.com/live/ID
        if (preg_match('/(?:youtu\.be\/|watch\?v=|\/live\/)([a-zA-Z0-9_-]{11})/', $youtubeId, $m)) {
            $youtubeId = $m[1];
        }
    }

    if (!$conexion) jsonError(500, 'Error de conexión');

    // Verificar si ya existe una fila
    $check = $conexion->query("SELECT COUNT(*) FROM live_config")->fetchColumn();

    if ($check > 0) {
        $conexion->prepare("
            UPDATE live_config
            SET youtube_id = ?, titulo = ?, descripcion = ?,
                activo = ?, mostrar_chat = ?, updated_by = ?
            LIMIT 1
        ")->execute([$youtubeId ?: null, $titulo, $descripcion, $activo, $mostrarChat, $admin['id']]);
    } else {
        $conexion->prepare("
            INSERT INTO live_config (youtube_id, titulo, descripcion, activo, mostrar_chat, updated_by)
            VALUES (?, ?, ?, ?, ?, ?)
        ")->execute([$youtubeId ?: null, $titulo, $descripcion, $activo, $mostrarChat, $admin['id']]);
    }

    jsonOk(['mensaje' => 'Configuración actualizada']);
}

jsonError(405, 'Método no permitido');