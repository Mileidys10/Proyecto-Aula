<?php
session_start();

// Verifica si el usuario tiene una sesión activa y es administrador
if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin') {
    // El usuario es administrador, continúa con la lógica
    echo "Bienvenido, administrador.";
        header("Location: ../View/admin/admin.php");  

} else {
    // El usuario no es administrador, redirige al inicio
    header("Location: ../View/index.php");
    exit;
}
?>