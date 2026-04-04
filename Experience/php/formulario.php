<?php
// ======================================================
// FORMULARIO - PROCESAMIENTO + BD + ENVÍO DE CORREOS
// ======================================================

header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(E_ALL);
ob_start();

require_once __DIR__ . '/conexion_bd.php';

if (!$conexion) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos.']);
    exit;
}

require_once __DIR__ . '/enviar_correos.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    exit;
}

// RECIBIR DATOS
$nombre    = trim($_POST["nombre"] ?? '');
$email     = trim($_POST["email"] ?? '');
$telefono  = trim($_POST["tel"] ?? '');
$programa  = trim($_POST["programa"] ?? '');

// VALIDACIONES
if (empty($nombre) || empty($email) || empty($telefono) || empty($programa)) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Correo electrónico no válido.']);
    exit;
}

$telefonoLimpio = preg_replace('/\D/', '', $telefono);
if (strlen($telefonoLimpio) < 7 || strlen($telefonoLimpio) > 15) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Número de teléfono no válido.']);
    exit;
}

// INSERT BD
try {
    $stmt = $conexion->prepare(
        "INSERT INTO leads_formulario (nombre_completo, email, telefono, programa_interes)
         VALUES (:nombre, :email, :telefono, :programa)"
    );
    $stmt->execute([
        ':nombre'    => $nombre,
        ':email'     => $email,
        ':telefono'  => $telefonoLimpio,
        ':programa'  => $programa
    ]);

    // ENVÍO DE CORREOS (no interrumpe aunque falle)
    try {
        enviarCorreos([
            'nombre'    => $nombre,
            'email'     => $email,
            'telefono'  => $telefonoLimpio,
            'programa'  => $programa
        ]);
    } catch (Exception $mailError) {
        error_log("Error correo: " . $mailError->getMessage());
    }

    ob_end_clean();
    echo json_encode(['success' => true, 'message' => 'Registro guardado.']);
    exit;

} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        ob_end_clean();
        echo json_encode(['success' => false, 'message' => 'Este correo ya está registrado.']);
        exit;
    }
    error_log("Error BD: " . $e->getMessage());
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Error al guardar el registro.']);
    exit;
}