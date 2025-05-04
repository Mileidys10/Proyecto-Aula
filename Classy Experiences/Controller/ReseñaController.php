<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../Config/Conexion.php';
require_once '../Model/Reseña.php';

if (!isset($_SESSION['id'])) {
    header("Location: ../View/login.php");
    exit();
}

$conexion = new mysqli("localhost", "root", "", "classy");
$reseñaModel = new Reseña($conexion);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resenar'])) {
    $comentario = trim($_POST["comentario"]);
    $puntuacion = trim($_POST["puntuacion"]);
    $nombre = $_SESSION['nombre']; // Aquí tomamos el nombre desde la sesión

    if ($comentario !== "" && $puntuacion !== "") {
        $resultado = $reseñaModel->agregarReseña($nombre, $comentario, $puntuacion);
        if ($resultado) {
            header("Location: ../View/gracias.php");
            exit();
        } else {
            $mensaje = "Ups, ocurrió un error. Intenta nuevamente.";
        }
    } else {
        $mensaje = "¡Completa todos los campos!";
    }
}
?>