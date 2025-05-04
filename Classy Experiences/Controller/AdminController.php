<?php
session_start();

// Verifica si hay sesión activa
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../View/login.php');
    exit();
}

// Si todo está bien, recupera el nombre
$admin_nombre = $_SESSION['admin_nombre']; 
?>