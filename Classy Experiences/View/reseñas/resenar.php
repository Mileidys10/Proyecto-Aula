<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    echo "Sesión no iniciada. Redirigiendo al login...";
    header("Location: ../View/login.php");
    exit();
} else {
    echo "Sesión iniciada. Usuario: " . $_SESSION['nombre'];
}
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