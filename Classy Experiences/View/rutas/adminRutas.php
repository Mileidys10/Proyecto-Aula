<?php
// Verifica si la sesión está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario está autenticado y es administrador
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    // Redirige al login si no está autenticado
    header("Location: login.php?msg=¡Debes iniciar sesión como administrador!");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD DE RUTAS</title>
</head>
<body>
            <a href="../../View/admin/admin.php">Home</a>
            <a href="../rutas/agregarRuta.php">Agregar Ruta</a>
            <a href="../rutas/mostrarRutas.php">Mostrar Rutas</a>
            <a href="../rutas/adminRutas.php">Inicio</a>
</body>
</html>