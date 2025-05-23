<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    echo "Sesión no iniciada. Redirigiendo al login...";
    header("Location: ../View/login.php");
    exit();
} 
$usuarioActivo = isset($_SESSION['id']); 

require_once '../../Controller/ReseñaController.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Reseña</title>
    <link rel="stylesheet" href="../../Css/resenas.css">
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
  
<a href="../../view/login/perfil.php" title="Perfil">
    <i class="fas fa-user"></i>
</a>
        </nav>
    </header>
    <main class="formulario-reseña">
        <h2>Agrega tu Reseña</h2>
        <?php if (isset($mensaje)) echo "<p class='error'>$mensaje</p>"; ?>
        <form method="post">
            <label for="comentario">Comentario:</label><br>
            <textarea name="comentario" rows="5" required></textarea><br><br>

            <label for="puntuacion">Puntuación:</label><br>
            <select name="puntuacion" required>
                <option value="">Selecciona</option>
                <option value="1">1 estrella</option>
                <option value="2">2 estrellas</option>
                <option value="3">3 estrellas</option>
                <option value="4">4 estrellas</option>
                <option value="5">5 estrellas</option>
            </select><br><br>

            <button type="submit" name="resenar">Enviar Reseña</button>
        </form>
    </main>
</body>
</html>