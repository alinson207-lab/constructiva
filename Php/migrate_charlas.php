<?php
// ============================================================
//  CONSTRUCTIVA · Script de Migración — USAR UNA SOLA VEZ
//  Agrega columna curso_id a la tabla charlas
//  ⚠️  ELIMINAR ESTE ARCHIVO DESPUÉS DE EJECUTAR
// ============================================================
require_once __DIR__ . '/conexion_bd.php';

// Verificar si ya existe la columna
$check = $conexion->query("SHOW COLUMNS FROM charlas LIKE 'curso_id'");
if ($check->rowCount() > 0) {
    echo "✅ La columna curso_id ya existe en la tabla charlas. No se requiere migración.<br>";
    exit;
}

// Agregar la columna
try {
    $conexion->exec("
        ALTER TABLE charlas
        ADD COLUMN curso_id INT NULL DEFAULT NULL,
        ADD INDEX idx_charlas_curso_id (curso_id)
    ");
    echo "✅ Columna curso_id agregada exitosamente a la tabla charlas.<br>";
    echo "⚠️  Por favor, elimina este archivo del servidor: <code>Php/migrate_charlas.php</code>";
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
