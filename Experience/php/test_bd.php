<?php
// ======================================================
// ARCHIVO DE DIAGNÓSTICO - BORRAR DESPUÉS DE USARLO
// Súbelo a: public_html/php/test_bd.php
// Ábrelo en el navegador: tudominio.com/php/test_bd.php
// ======================================================

echo "<h2>🔍 Diagnóstico Constructiva</h2><pre>";

// 1. Versión PHP
echo "PHP Version: " . phpversion() . "\n";

// 2. Extensiones necesarias
echo "\n--- Extensiones ---\n";
echo "PDO:        " . (extension_loaded('pdo') ? '✅' : '❌') . "\n";
echo "PDO_MySQL:  " . (extension_loaded('pdo_mysql') ? '✅' : '❌') . "\n";
echo "OpenSSL:    " . (extension_loaded('openssl') ? '✅' : '❌') . "\n";

// 3. Conexión BD
echo "\n--- Conexión Base de Datos ---\n";
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
    echo "Conexión BD: ✅ OK\n";

    // 4. Verificar tabla
    echo "\n--- Tabla leads_formulario ---\n";
    try {
        $stmt = $conexion->query("DESCRIBE leads_formulario");
        $cols = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "Tabla existe: ✅\n";
        echo "Columnas:\n";
        foreach ($cols as $col) {
            echo "  - {$col['Field']} ({$col['Type']})" . ($col['Key'] === 'UNI' ? ' [UNIQUE]' : '') . "\n";
        }
    } catch (PDOException $e) {
        echo "Tabla existe: ❌ NO EXISTE\n";
        echo "Error: " . $e->getMessage() . "\n";
        echo "\n⚠️  Crea la tabla con este SQL en Hostinger → Databases → phpMyAdmin:\n\n";
        echo "CREATE TABLE leads_formulario (\n";
        echo "    id INT AUTO_INCREMENT PRIMARY KEY,\n";
        echo "    nombre_completo VARCHAR(255) NOT NULL,\n";
        echo "    email VARCHAR(255) NOT NULL UNIQUE,\n";
        echo "    telefono VARCHAR(20),\n";
        echo "    programa_interes VARCHAR(100),\n";
        echo "    profesion VARCHAR(100),\n";
        echo "    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP\n";
        echo ");\n";
    }

    // 5. Test insert
    echo "\n--- Test INSERT ---\n";
    try {
        $stmt = $conexion->prepare(
            "INSERT INTO leads_formulario (nombre_completo, email, telefono, programa_interes, profesion)
             VALUES (:nombre, :email, :telefono, :programa, :profesion)"
        );
        $stmt->execute([
            ':nombre'    => 'Test Usuario',
            ':email'     => 'test_' . time() . '@test.com',
            ':telefono'  => '8091234567',
            ':programa'  => 'programa_completo',
            ':profesion' => 'Ingeniero'
        ]);
        echo "INSERT: ✅ OK (id: " . $conexion->lastInsertId() . ")\n";

        // Limpiar registro de prueba
        $conexion->exec("DELETE FROM leads_formulario WHERE nombre_completo = 'Test Usuario'");
        echo "Limpieza: ✅ Registro de prueba eliminado\n";

    } catch (PDOException $e) {
        echo "INSERT: ❌ FALLÓ\n";
        echo "Error: " . $e->getMessage() . "\n";
    }

} catch (PDOException $e) {
    echo "Conexión BD: ❌ FALLÓ\n";
    echo "Error: " . $e->getMessage() . "\n";
}

// 6. Rutas de archivos
echo "\n--- Rutas de archivos ---\n";
echo "__DIR__: " . __DIR__ . "\n";
$archivos = ['conexion_bd.php', 'enviar_correos.php', 'formulario.php'];
foreach ($archivos as $archivo) {
    $ruta = __DIR__ . '/' . $archivo;
    echo "$archivo: " . (file_exists($ruta) ? '✅ existe' : '❌ NO EXISTE') . "\n";
}

// 7. Vendor/autoload
echo "\n--- PHPMailer (vendor) ---\n";
$paths = [
    __DIR__ . '/vendor/autoload.php',
    __DIR__ . '/../vendor/autoload.php',
    __DIR__ . '/../../vendor/autoload.php',
];
$found = false;
foreach ($paths as $path) {
    if (file_exists($path)) {
        echo "autoload.php: ✅ encontrado en:\n  $path\n";
        $found = true;
        break;
    }
}
if (!$found) {
    echo "autoload.php: ❌ NO ENCONTRADO\n";
    echo "➡️  Ejecuta en SSH dentro de /php/: composer require phpmailer/phpmailer\n";
}

echo "\n✅ Diagnóstico completo.\n";
echo "</pre>";
echo "<p style='color:red;font-weight:bold'>⚠️ IMPORTANTE: Borra este archivo del servidor cuando termines.</p>";
?>