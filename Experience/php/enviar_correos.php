<?php
function enviarCorreos($datos) {

    $nombresProgramas = [
        'programa_completo'  => 'Programa Completo (todos los workshops)',
        'revit'              => 'Evita Demoliciones en Obra con BIM - Revit',
        'ia'                 => 'Inteligencia Artificial aplicada a la construcción',
        'ms-project'         => 'Planifica tu obra con Ms Project',
        'neurocomunicacion'  => 'Neurocomunicación Estratégica',
        'marca-personal'     => 'Marca Personal para Ingenieros',
        'ingles'             => 'Consultoría Inglés Profesional',
    ];

    $nombreUsuario   = htmlspecialchars($datos['nombre']);
    $emailUsuario    = htmlspecialchars($datos['email']);
    $telefono        = htmlspecialchars($datos['telefono']);
    $programaKey     = $datos['programa'];
    $programa        = htmlspecialchars($nombresProgramas[$programaKey] ?? $programaKey);

    $remitente       = 'info@constructiva.edu.do';
    $nombreRemitente = 'Constructiva Experience';

    // ===================================================
    // ESTE ES EL FIX: el 5to parámetro -f establece el
    // envelope sender real. Sin esto, Hostinger envía
    // "on behalf of srv1849..." y va a spam.
    // ===================================================
    $parametroRemitente = '-f' . $remitente;

    // CORREO AL USUARIO
    $asuntoUsuario = '=?UTF-8?B?' . base64_encode('¡Gracias por tu interés en Constructiva Experience!') . '?=';
    $cuerpoUsuario = '<html><body style="font-family:Arial,sans-serif;color:#333;max-width:600px;margin:0 auto;">
        <div style="background:#0d1f1f;padding:30px;text-align:center;">
            <h1 style="color:#36DBCA;margin:0;">Constructiva Experience</h1>
            <p style="color:#aaa;margin:5px 0 0;">Learn. Apply. Lead.</p>
        </div>
        <div style="padding:30px;">
            <h3>Hola ' . $nombreUsuario . ',</h3>
            <p>Hemos recibido correctamente tu solicitud para el programa:</p>
            <p style="background:#f0fffe;border-left:4px solid #36DBCA;padding:12px 16px;font-weight:bold;">' . $programa . '</p>
            <p>Uno de nuestros asesores se pondrá en contacto contigo en <strong>menos de 24 horas</strong>.</p>
            <p>Síguenos en Instagram: <a href="https://www.instagram.com/constructiva__/" style="color:#36DBCA;">@constructiva__</a></p>
            <p>O escríbenos por WhatsApp: <a href="https://wa.me/18294910540" style="color:#36DBCA;">+1 829 491 0540</a></p>
        </div>
        <div style="background:#f5f5f5;padding:20px;text-align:center;font-size:12px;color:#999;">
            © 2026 Constructiva Experience. Todos los derechos reservados.
        </div>
    </body></html>';

    $headersUsuario  = "MIME-Version: 1.0\r\n";
    $headersUsuario .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headersUsuario .= "From: {$nombreRemitente} <{$remitente}>\r\n";
    $headersUsuario .= "Reply-To: {$remitente}\r\n";
    $headersUsuario .= "X-Mailer: PHP/" . phpversion();

    $envioUsuario = mail($emailUsuario, $asuntoUsuario, $cuerpoUsuario, $headersUsuario, $parametroRemitente);

    // CORREO AL ADMIN
    $asuntoAdmin = '=?UTF-8?B?' . base64_encode('Nuevo lead registrado - Constructiva') . '?=';
    $cuerpoAdmin = '<html><body style="font-family:Arial,sans-serif;color:#333;max-width:600px;margin:0 auto;">
        <div style="background:#0d1f1f;padding:20px;">
            <h2 style="color:#36DBCA;margin:0;">Nuevo Lead Registrado</h2>
        </div>
        <div style="padding:30px;">
            <table style="width:100%;border-collapse:collapse;">
                <tr style="border-bottom:1px solid #eee;">
                    <td style="padding:10px;font-weight:bold;width:40%;background:#f9f9f9;">Nombre</td>
                    <td style="padding:10px;">' . $nombreUsuario . '</td>
                </tr>
                <tr style="border-bottom:1px solid #eee;">
                    <td style="padding:10px;font-weight:bold;background:#f9f9f9;">Email</td>
                    <td style="padding:10px;">' . $emailUsuario . '</td>
                </tr>
                <tr style="border-bottom:1px solid #eee;">
                    <td style="padding:10px;font-weight:bold;background:#f9f9f9;">Teléfono</td>
                    <td style="padding:10px;">' . $telefono . '</td>
                </tr>
                <tr>
                    <td style="padding:10px;font-weight:bold;background:#f9f9f9;">Programa</td>
                    <td style="padding:10px;">' . $programa . '</td>
                </tr>
            </table>
        </div>
    </body></html>';

    $headersAdmin  = "MIME-Version: 1.0\r\n";
    $headersAdmin .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headersAdmin .= "From: {$nombreRemitente} <{$remitente}>\r\n";
    $headersAdmin .= "Reply-To: {$emailUsuario}\r\n";
    $headersAdmin .= "X-Mailer: PHP/" . phpversion();

    $envioAdmin = mail($remitente, $asuntoAdmin, $cuerpoAdmin, $headersAdmin, $parametroRemitente);

    if (!$envioUsuario || !$envioAdmin) {
        error_log("Correos: usuario=" . ($envioUsuario ? 'OK' : 'FALLÓ') . " admin=" . ($envioAdmin ? 'OK' : 'FALLÓ'));
    }

    return true;
}