<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../Model/logic/phpmailer/src/Exception.php';
require '../../Model/logic/phpmailer/src/PHPMailer.php';
require '../../Model/logic/phpmailer/src/SMTP.php';
require '../../Config/Conexion.php';

session_start();
$id_usuario = isset($_SESSION['id']) ? $_SESSION['id'] : null;

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
        $mail->Username = 'classyexperiences123@gmail.com';
        $mail->Password = 'aouo kuqp xrng udrw';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Contenido del correo
        $mail->setFrom($mail->Username, 'Classy Experiences');
        $mail->addAddress($mail->Username);

        $mail->Subject = "Atención al cliente de $email";
        $mail->Body    = "Nombre: $nombre\nEmail: $email\nMensaje: $mensaje";

        $mail->send();

        // CONEXIÓN A BASE DE DATOS
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("INSERT INTO contacto (nombre, email, mensaje, id_usuario) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $nombre, $email, $mensaje, $id_usuario);
        $stmt->execute();
        $stmt->close();

        // Mostrar alerta y redirigir con JavaScript
        echo "<script>
            alert('¡Mensaje enviado correctamente! Pronto nos pondremos en contacto contigo.');
            window.location.href = '../../View/index.php';
        </script>";
        exit;
    } catch (Exception $e) {
        echo "<script>
            alert('Error al enviar el mensaje: {$mail->ErrorInfo}');
            window.history.back();
        </script>";
        exit;
    }
}

