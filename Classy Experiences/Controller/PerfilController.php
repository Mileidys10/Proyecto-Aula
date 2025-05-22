<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    // Si no está logeado, redirige a login
    header("Location: ../login/login.php");
    exit();
}

// Si necesitas cargar datos del usuario, puedes hacerlo aquí
require_once __DIR__ . '/../Model/CRUD/crudUsuario.php';
$usuario = crudUsuario::obtenerUsuarioPorId($_SESSION['id']);

// Ahora $usuario estará disponible en perfil.php si lo incluyes