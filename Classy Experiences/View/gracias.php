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
    <link rel="stylesheet" href="../Css/estilo.css">
    <title>Gracias por tu reseña</title>
</head>
<body>

<header>
        <a class="logo" href="../View/index.php">
            <img src="../Media/classy.png" alt="logo">
            <h2 class="nombredelaempresa">Classy</h2>
        </a>

        <nav>
        <a href="../View/index.php">Home</a>
        <a href="../View/login.php">Iniciar Sesion</a>
        <a href="../View/servicios.html">Servicios</a>
            <a href="../View/conocenos.html">Conócenos</a>
            <a href="../View/redes.html">Redes Sociales</a>
            <a href="../View/resenas.php">Reseñas</a>
            <?php if ($usuarioActivo): ?>
    <a href="../Controller/LogoutController.php">Cerrar sesión</a>
<?php endif; ?>
        </nav>
    </header>

    <main>
        <h1>¡Gracias por tu reseña!</h1>
        <h3>Tu comentario ha sido enviado correctamente. Te agradecemos por compartir tu experiencia con nosotros.
<p>A continuación serás redirigido a la pagina de reseñas.</p>

        </h3>
        <button><a href="../View/index.php">Volver al inicio</a></button>
    </main>

</body>
</html>

<script>
    setTimeout(function() {
        window.location.href = "../View/resenas.php";  
    }, 5000);
</script>