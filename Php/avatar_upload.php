<?php
// ============================================================
//  POST /Php/avatar_upload.php  → sube foto de perfil
// ============================================================
require_once __DIR__ . '/auth.php';

corsHeaders();
$user = requireAuth();
global $conexion;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') jsonError(405, 'Método no permitido');

$file = $_FILES['foto'] ?? null;
if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
    jsonError(400, 'No se recibió ningún archivo');
}

// Validar tipo
$allowed = ['image/jpeg', 'image/png', 'image/webp'];
$finfo   = new finfo(FILEINFO_MIME_TYPE);
$mime    = $finfo->file($file['tmp_name']);
if (!in_array($mime, $allowed)) {
    jsonError(400, 'Solo se aceptan imágenes JPG, PNG o WEBP');
}

// Validar tamaño (5 MB)
if ($file['size'] > 5 * 1024 * 1024) {
    jsonError(400, 'La imagen no puede superar 5 MB');
}

// Redimensionar a 400x400 con GD
$ext = match($mime) {
    'image/jpeg' => 'jpg',
    'image/png'  => 'png',
    'image/webp' => 'webp',
};

$src = match($mime) {
    'image/jpeg' => imagecreatefromjpeg($file['tmp_name']),
    'image/png'  => imagecreatefrompng($file['tmp_name']),
    'image/webp' => imagecreatefromwebp($file['tmp_name']),
};

if (!$src) jsonError(500, 'Error al procesar la imagen');

$w = imagesx($src);
$h = imagesy($src);
$size = min($w, $h); // recorte cuadrado centrado
$x = intval(($w - $size) / 2);
$y = intval(($h - $size) / 2);

$dst = imagecreatetruecolor(400, 400);

// Fondo transparente para PNG
if ($mime === 'image/png') {
    imagealphablending($dst, false);
    imagesavealpha($dst, true);
}

imagecopyresampled($dst, $src, 0, 0, $x, $y, 400, 400, $size, $size);

// Convertir a JPEG para guardar (uniforme)
ob_start();
imagejpeg($dst, null, 88);
$imageData = ob_get_clean();

imagedestroy($src);
imagedestroy($dst);

// Guardar en la BD como BLOB (o en disco si prefieres)
// Opción BD (más simple, sin gestión de archivos):
$stmt = $conexion->prepare("UPDATE usuarios SET avatar_foto = ? WHERE id = ?");
$stmt->execute([$imageData, $user['id']]);

// Actualizar localStorage: marcar que tiene foto
jsonOk(['mensaje' => 'Foto actualizada', 'tiene_foto' => true]);