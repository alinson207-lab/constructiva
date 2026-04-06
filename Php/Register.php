<?php

require_once "conexion_bd.php";

$nombre   = trim($_POST['nombre']           ?? '');
$apellido = trim($_POST['apellido']         ?? '');
$email    = trim($_POST['email']            ?? '');
$password = trim($_POST['password']         ?? '');
$confirm  = trim($_POST['confirm_password'] ?? '');

if ($nombre == "" || $apellido == "" || $email == "" || $password == "") {
    echo "<script>alert('Debe completar todos los campos'); window.location='/registro';</script>";
    exit();
}

if ($password != $confirm) {
    echo "<script>alert('Las contraseñas no coinciden'); window.location='/registro';</script>";
    exit();
}

if (strlen($password) < 8) {
    echo "<script>alert('La contraseña debe tener al menos 8 caracteres'); window.location='/registro';</script>";
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('El formato del correo electrónico no es válido'); window.location='/registro';</script>";
    exit();
}

if (!$conexion) {
    echo "<script>alert('Error de conexión a la base de datos'); window.location='/registro';</script>";
    exit();
}

/* Verificar si el email ya existe */
$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->execute([$email]);

if ($stmt->fetch()) {
    echo "<script>alert('El correo ya está registrado'); window.location='/registro';</script>";
    exit();
}

/* Encriptar contraseña */
$passwordHash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

/* Insertar usuario con todas las columnas requeridas */
$stmt = $conexion->prepare("
    INSERT INTO usuarios (nombre, apellido, email, password_hash, rol, activo)
    VALUES (?, ?, ?, ?, 'estudiante', 1)
");
$stmt->execute([$nombre, $apellido, $email, $passwordHash]);

echo "<script>alert('Cuenta creada correctamente'); window.location='/login';</script>";