<?php
require_once '../../Controller/ReseñaController.php';
require_once '../../Model/CRUD/crudReseñas.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$usuarioActivo = isset($_SESSION['id']); 


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Css/resenas.css">
    <title>Classy Experiences - Reseñas</title>
</head>

<body>
    <header>
        <a class="logo" href="../View/index.php">
            <img src="../../img/classy.png" alt="logo">
            <h2 class="nombredelaempresa">Classy</h2>
        </a>
        <nav>
            <a href="../../View/index.php">Home</a>
            <a href="../../View/servicios.php">Servicios</a>
            <a href="../../View/conocenos.php">Conócenos</a>
            <a href="../../View/redes.php">Redes Sociales</a>
            <a href="../reseñas/resenas.php">Reseñas</a>
                 <?php if (!$usuarioActivo): ?>
    <a href="../View/login/login.php">Iniciar Sesion</a>
<?php else: ?>
    <a href="../Controller/LogoutController.php">Cerrar sesión</a>
<?php endif; ?>
        </nav>
    </header>

    <main>
        <section class="inicio">
            <h1>¡Comparte tu experiencia con nosotros!</h1>
            <p>Queremos saber lo que piensas sobre nuestros servicios.</p>
            <div class="reseñar-boton">
                <a href="../reseñas/resenar.php">Agregar Reseña</a>
            </div>
        </section>

        <section class="contenido">
            <?php
            $crudResenas = new crudReseñas();
            $reseñas = $crudResenas->obtenerReseñas();
            foreach ($reseñas as $resena):
            ?>
                <div class="resena">
                    <div class="resena-header">
                        <img src="../../img/avatar.png" alt="Avatar" class="avatar">
                        <div>
                            <h3><?= htmlspecialchars($resena->getNombre()) ?></h3>
                            <p class="fecha"><?= htmlspecialchars($resena->getFecha()) ?></p>
                        </div>
                        <div class="estrellas">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                echo $i <= $resena->getPuntuacion() ? "&#9733;" : "&#9734;";
                            }
                            ?>
                        </div>
                    </div>
                    <p class="comentario"><?= htmlspecialchars('"' . $resena->getComentario() . '"') ?></p>
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