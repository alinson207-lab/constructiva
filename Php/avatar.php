<?php
// ============================================================
//  GET /Php/avatar.php?id=X  → sirve la foto de perfil
//  No requiere autenticación (la foto es pública)
// ============================================================
require_once __DIR__ . '/conexion_bd.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) { http_response_code(404); exit; }

$stmt = $conexion->prepare("SELECT avatar_foto FROM usuarios WHERE id = ? AND activo = 1");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row || empty($row['avatar_foto'])) {
    http_response_code(404);
    exit;
}

// Cache 1 hora
header('Content-Type: image/jpeg');
header('Cache-Control: public, max-age=3600');
header('Content-Length: ' . strlen($row['avatar_foto']));
echo $row['avatar_foto'];
exit;