<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resenas.css">
    <title>Classy Experiences - Reseñas</title>
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
        <section class="inicio">
            <h1>¡Comparte tu experiencia con nosotros!</h1>
            <p>Queremos saber lo que piensas sobre nuestros servicios.</p>
        
        <div class="reseñar-boton">
        <a href="resenar.php">Agregar Reseña</a>
    </div>
    </section>
        <section class="contenido">
            <?php
            include("mostrarregistros.php");
            ?>
        </section>
    </main>

    
    <footer>
        <div class="container">
            <p>&copy; 2024 Classy Experiences. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>
