<?php
require_once __DIR__ . '/../Model/CRUD/crudRutas.php';
require_once __DIR__ . '/../Model/Route.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];
    if ($accion === 'agregar') {
        $ruta = new Ruta();
        $ruta->setNombreRuta($_POST['nombre_ruta']);
        $ruta->setDescripcion($_POST['descripcion']);
        $ruta->setFecha($_POST['fecha']);
        $ruta->setConductorId($_POST['conductor_id']);
        $ruta->setGuiaId($_POST['guia_id']);
        crudRutas::agregar($ruta);
        header("Location: ../View/mostrarRutas.php");
        exit;
    }
    if ($accion === 'editar') {
        $ruta = new Ruta();
        $ruta->setId($_POST['id']);
        $ruta->setNombreRuta($_POST['nombre_ruta']);
        $ruta->setDescripcion($_POST['descripcion']);
        $ruta->setFecha($_POST['fecha']);
        $ruta->setConductorId($_POST['conductor_id']);
        $ruta->setGuiaId($_POST['guia_id']);
        crudRutas::editar($ruta);
        header("Location: ../View/mostrarRutas.php");
        exit;
    }
}
if ($_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    crudRutas::eliminar($_GET['id']);
    header("Location: ../View/mostrarRutas.php");
    exit;
}
?>