<?php
// ======================================================
// REGISTRO NOTIFICACIÓN MASTERCLASS
// public_html/php/registro_notificacion.php
//
// Recibe: email (POST)
// Valida: formato + DNS/MX del dominio
// Guarda: en BD tabla notificaciones_masterclass
// Envía:  correo de confirmación al usuario
//         correo de aviso al admin
// ======================================================

header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(E_ALL);
ob_start();

require_once __DIR__ . '/conexion_bd.php';

// ── Solo POST ────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    exit;
}

// ── Recibir y limpiar email ──────────────────────────
$email = trim($_POST['email'] ?? '');

if (empty($email)) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'El correo es obligatorio.']);
    exit;
}

// ── VALIDACIÓN 1: Formato básico ─────────────────────
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'El formato del correo no es válido.']);
    exit;
}

// ── VALIDACIÓN 2: DNS/MX — verifica que el dominio
//    tiene servidor de correo real configurado.
//    Elimina dominios falsos como test@asdfjkl.com
// ────────────────────────────────────────────────────
$dominio = substr(strrchr($email, '@'), 1);
$mxRecords = [];
$dominioValido = false;

// Primero intenta MX records (más específico para email)
if (function_exists('getmxrr') && getmxrr($dominio, $mxRecords)) {
    $dominioValido = true;
} elseif (checkdnsrr($dominio, 'A')) {
    // Fallback: algunos dominios usan A record en vez de MX
    $dominioValido = true;
}

if (!$dominioValido) {
    ob_end_clean();
    echo json_encode([
        'success' => false,
        'message' => 'El dominio del correo no parece válido. Verifica que esté bien escrito.'
    ]);
    exit;
}

// ── VALIDACIÓN 3: BD disponible ──────────────────────
if (!$conexion) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Error de conexión. Intenta más tarde.']);
    exit;
}

// ── Crear tabla si no existe ─────────────────────────
try {
    $conexion->exec("
        CREATE TABLE IF NOT EXISTS notificaciones_masterclass (
            id               INT AUTO_INCREMENT PRIMARY KEY,
            email            VARCHAR(255) NOT NULL UNIQUE,
            fecha_registro   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            notificado       TINYINT(1) DEFAULT 0
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");
} catch (PDOException $e) {
    error_log('Error creando tabla: ' . $e->getMessage());
}

// ── Guardar en BD ────────────────────────────────────
try {
    $stmt = $conexion->prepare(
        "INSERT INTO notificaciones_masterclass (email) VALUES (:email)"
    );
    $stmt->execute([':email' => $email]);

} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        // Email duplicado — lo tratamos como éxito para no dar info
        ob_end_clean();
        echo json_encode([
            'success' => true,
            'message' => 'Ya estás registrado. Te avisaremos antes del inicio.'
        ]);
        exit;
    }
    error_log('Error BD notificacion: ' . $e->getMessage());
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'Error al guardar. Intenta de nuevo.']);
    exit;
}

// ── Enviar correos ────────────────────────────────────
$remitente       = 'info@constructiva.edu.do';
$nombreRemitente = 'Constructiva Experience';
$parametroSender = '-f' . $remitente;
$emailSeguro     = htmlspecialchars($email);

// Correo al usuario
$asuntoUsuario = '=?UTF-8?B?' . base64_encode('Te notificaremos antes de la Masterclass — Constructiva') . '?=';
$cuerpoUsuario = '
<html>
<body style="font-family:Arial,sans-serif;color:#333;max-width:600px;margin:0 auto;background:#f9f9f9;">

  <div style="background:#0d1f1f;padding:32px;text-align:center;">
    <img src="https://constructiva.edu.do/img/Logo_aqua.png"
         alt="Constructiva Experience"
         style="height:48px;width:auto;" />
  </div>

  <div style="background:#ffffff;padding:36px 32px;">
    <h2 style="color:#0d1f1f;font-size:22px;margin:0 0 12px;">
      ¡Listo, te avisamos! 🎉
    </h2>
    <p style="font-size:15px;line-height:1.6;color:#444;margin:0 0 20px;">
      Tu correo <strong>' . $emailSeguro . '</strong> quedó registrado correctamente.
      Te enviaremos un recordatorio antes de que comience la masterclass.
    </p>

    <div style="background:#f0fffe;border-left:4px solid #36DBCA;padding:16px 20px;border-radius:4px;margin-bottom:24px;">
      <p style="margin:0;font-size:14px;font-weight:bold;color:#0d1f1f;">
        📅 Masterclass gratuita
      </p>
      <p style="margin:6px 0 0;font-size:14px;color:#444;">
        <strong>Habla con tus planos — Revisión de proyectos con Inteligencia Artificial</strong>
      </p>
      <p style="margin:6px 0 0;font-size:14px;color:#1D756C;">
        Martes 24 de marzo &nbsp;·&nbsp; 8:00 p.m.
      </p>
    </div>

    <p style="font-size:13px;color:#888;line-height:1.6;margin:0 0 24px;">
      Mientras tanto, síguenos en Instagram para no perderte ninguna novedad:
    </p>

    <div style="text-align:center;margin-bottom:28px;">
      <a href="https://www.instagram.com/constructiva__/"
         style="display:inline-block;background:#36DBCA;color:#061212;font-weight:700;
                font-size:14px;padding:12px 28px;border-radius:100px;text-decoration:none;">
        Seguir @constructiva__
      </a>
    </div>

    <p style="font-size:13px;color:#aaa;margin:0;">
      También puedes escribirnos por
      <a href="https://wa.me/18294910540" style="color:#36DBCA;text-decoration:none;">WhatsApp</a>
      si tienes alguna pregunta.
    </p>
  </div>

  <div style="background:#f0f0f0;padding:18px;text-align:center;font-size:11px;color:#aaa;">
    © 2026 Constructiva Experience. Todos los derechos reservados.<br>
    <a href="https://constructiva.edu.do" style="color:#36DBCA;text-decoration:none;">constructiva.edu.do</a>
  </div>

</body>
</html>';

$headersUsuario  = "MIME-Version: 1.0\r\n";
$headersUsuario .= "Content-Type: text/html; charset=UTF-8\r\n";
$headersUsuario .= "From: {$nombreRemitente} <{$remitente}>\r\n";
$headersUsuario .= "Reply-To: {$remitente}\r\n";
$headersUsuario .= "X-Mailer: PHP/" . phpversion();

$envioUsuario = mail($email, $asuntoUsuario, $cuerpoUsuario, $headersUsuario, $parametroSender);

// Correo al admin
$asuntoAdmin = '=?UTF-8?B?' . base64_encode('Nuevo registro notificación masterclass') . '?=';
$cuerpoAdmin = '
<html>
<body style="font-family:Arial,sans-serif;color:#333;max-width:600px;margin:0 auto;">
  <div style="background:#0d1f1f;padding:20px;">
    <h2 style="color:#36DBCA;margin:0;font-size:18px;">Nuevo registro — Notificación Masterclass</h2>
  </div>
  <div style="padding:24px;">
    <table style="width:100%;border-collapse:collapse;font-size:14px;">
      <tr style="border-bottom:1px solid #eee;">
        <td style="padding:10px;font-weight:bold;background:#f9f9f9;width:35%;">Email</td>
        <td style="padding:10px;">' . $emailSeguro . '</td>
      </tr>
      <tr>
        <td style="padding:10px;font-weight:bold;background:#f9f9f9;">Fecha</td>
        <td style="padding:10px;">' . date('d/m/Y H:i:s') . '</td>
      </tr>
    </table>
  </div>
</body>
</html>';

$headersAdmin  = "MIME-Version: 1.0\r\n";
$headersAdmin .= "Content-Type: text/html; charset=UTF-8\r\n";
$headersAdmin .= "From: {$nombreRemitente} <{$remitente}>\r\n";
$headersAdmin .= "Reply-To: {$email}\r\n";
$headersAdmin .= "X-Mailer: PHP/" . phpversion();

mail($remitente, $asuntoAdmin, $cuerpoAdmin, $headersAdmin, $parametroSender);

if (!$envioUsuario) {
    error_log("Fallo envío confirmación a: {$email}");
}

ob_end_clean();
echo json_encode([
    'success' => true,
    'message' => 'Registro exitoso. Revisa tu correo para confirmar.'
]);
exit;