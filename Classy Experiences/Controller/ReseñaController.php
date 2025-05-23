<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../Config/Conexion.php';
require_once __DIR__ . '/../Model/Entity/Reseña.php';
require_once __DIR__ . '/../Model/CRUD/crudReseñas.php';
// if (!isset($_SESSION['id'])) {
//  header("Location: /Classy Experiences/View/login/login.php");
//    exit();
// }

$conexion = new mysqli("localhost", "root", "", "classy");
$reseñaModel = new crudReseñas($conexion);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resenar'])) {
    $comentario = trim($_POST["comentario"]);
    $puntuacion = trim($_POST["puntuacion"]);
    $nombre = $_SESSION['nombre']; // Aquí tomamos el nombre desde la sesión

    if ($comentario !== "" && $puntuacion !== "") {
        $resultado = $reseñaModel->agregarReseña($nombre, $comentario, $puntuacion);
        if ($resultado) {
            header("Location:  /classy/View/reseñas/gracias.php");
            exit();
        } else {
            $mensaje = "Ups, ocurrió un error. Intenta nuevamente.";
        }
    } else {
        $mensaje = "¡Completa todos los campos!";
    }
}
?>