<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Gracias por tu reseña</title>
</head>
<body>

<header>
        <a class="logo" href="../index.php">
            <img src="../img/classy.png" alt="logo">
            <h2 class="nombredelaempresa">Classy</h2>
        </a>

        <nav>
        <a href="../index.php">Home</a>
            <a href="../servicios/servicios.html">Servicios</a>
            <a href="../conocenos/conocenos.html">Conócenos</a>
            <a href="../redes\redes.html">Redes Sociales</a>
            <a href="resenas.php">Reseñas</a>
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
        window.location.href = "resenas.php";  
    }, 5000);
</script>