<?php
require_once '../Controller/ReseñaController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$usuarioActivo = isset($_SESSION['id']); // Verifica si hay un usuario activo


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/resenas.css">
    <title>Classy Experiences - Reseñas</title>
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
        <section class="inicio">
            <h1>¡Comparte tu experiencia con nosotros!</h1>
            <p>Queremos saber lo que piensas sobre nuestros servicios.</p>
            <div class="reseñar-boton">
                <a href="resenar.php">Agregar Reseña</a>
            </div>
        </section>

        <section class="contenido">
            <?php
            $reseñas = $reseñaModel->obtenerReseñas();
            foreach ($reseñas as $row):
            ?>
            <div class="resena">
                <div class="resena-header">
                    <img src="../Media/avatar.png" alt="Avatar" class="avatar">
                    <div>
                        <h3><?= htmlspecialchars($row['nombre']) ?></h3>
                        <p class="fecha"><?= htmlspecialchars($row['fecha']) ?></p>
                    </div>
                    <div class="estrellas">
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            echo $i <= $row['puntuacion'] ? "&#9733;" : "&#9734;";
                        }
                        ?>
                    </div>
                </div>
                <p class="comentario"><?= htmlspecialchars('"' . $row['comentario'] . '"') ?></p>
            </div>
            <?php endforeach; ?>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Classy Experiences. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>