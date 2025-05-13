<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

if (isset($_POST["enviar"])) {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $mensaje = $_POST["mensaje"];

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP de Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'classyexperiences123@gmail.com'; // Tu correo Gmail
        $mail->Password = 'aouo kuqp xrng udrw'; // Usa clave de aplicación, no tu contraseña normal
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Contenido del correo
        $mail->setFrom($mail->Username, 'Classy Experiences');
        $mail->addAddress($mail->Username); // Puedes cambiar a otro destinatario si quieres

        $mail->Subject = "Atención al cliente de $email";
        $mail->Body    = "Nombre: $nombre\nEmail: $email\nMensaje: $mensaje";

        $mail->send();
        echo "<script>alert('El correo se envió correctamente :)');</script>";
    } catch (Exception $e) {
        echo "<script>alert('Error al enviar correo: {$mail->ErrorInfo}');</script>";
    }
}
?>