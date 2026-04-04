<?php
$host     = "localhost";
$dbname   = "u314398385_cursos_online";
$user     = "u314398385_user_cursos";
$password = 'Constructiva2026';

try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    error_log("Error de conexión BD: " . $e->getMessage());
    $conexion = null;
}