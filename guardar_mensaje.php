<?php
// PHPMailer
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Sanitize input
$nombre   = htmlspecialchars($_POST['nombre']);
$correo   = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$telefono = htmlspecialchars($_POST['telefono']);
$asunto   = htmlspecialchars($_POST['asunto']);
$mensaje  = htmlspecialchars($_POST['mensaje']);

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("❌ Correo inválido.");
}

$mail = new PHPMailer(true);

try {
    // SMTP Configuración
    $mail->isSMTP();
    $mail->Host       = 'smtp.office365.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'inv_foragroltda@hotmail.com';
    $mail->Password   = 'lhmphvmygthiyoqo'; // ⚠️ Reemplaza con App Password si tienes 2FA
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Contenido del correo
    $mail->setFrom('inv_foragroltda@hotmail.com', 'Contacto Agroceval');
    $mail->addAddress('agrocevalcolombia@hotmail.com'); // Receptor
    $mail->Subject = "Nuevo mensaje de contacto";
    $mail->Body    = "Has recibido un nuevo mensaje:\n\n"
                   . "Nombre: $nombre\n"
                   . "Correo: $correo\n"
                   . "Teléfono: $telefono\n"
                   . "Asunto: $asunto\n\n"
                   . "Mensaje:\n$mensaje";

    $mail->send();
    echo "📩 ¡Mensaje enviado correctamente!";

} catch (Exception $e) {
    echo "⚠️ Error al enviar el correo: {$mail->ErrorInfo}";
}
?>
