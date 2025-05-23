<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$usuarioActivo = isset($_SESSION['id']); // Verifica si hay un usuario activo
?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Css/resenar.css">
  
    <title>Gracias por tu reseña</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" crossorigin="anonymous"></script>

</head>
<body>

<header>
        <a class="logo" href="../View/index.php">
            <img src="/../Classy Experiences/img/classy.png" alt="logo">
            <h2 class="nombredelaempresa">Classy</h2>
        </a>

                 <nav>
            <a href="../../View/atencionCliente/contacto.php">Atención al cliente</a>
            <a href="../../View/index.php">Home</a>
            <a href="../../View/servicios.php">Servicios</a>
            <a href="../../View/conocenos.php">Conócenos</a>
            <a href="../../View/redes.php">Redes Sociales</a>
            <a href="../../View/reseñas/resenas.php">Reseñas</a>
                     <?php if (!$usuarioActivo): ?>
    <a href="../../View/login/login.php">Iniciar Sesion</a>
<?php else: ?>
    <a href="../../Controller/LogoutController.php" title="Cerrar sesión">
        <i class="fas fa-sign-out-alt"></i>
    </a>
<?php endif; ?>

<a href="../../view/perfil.php" title="Perfil">
    <i class="fas fa-user"></i>
</a>
        </nav>
    </header>

    <main>
        <h1>¡Gracias por tu reseña!</h1>
        <h3>Tu comentario ha sido enviado correctamente. Te agradecemos por compartir tu experiencia con nosotros.
<p>A continuación serás redirigido a la pagina de reseñas.</p>

        </h3>
        <button><a href="../index.php">Volver al inicio</a></button>
    </main>

</body>
</html>

<script>
    setTimeout(function() {
        window.location.href = "../reseñas/resenas.php";  
    }, 5000);
</script>