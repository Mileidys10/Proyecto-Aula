<?php
require_once '../Model/Servicio.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y obtener los datos del formulario
    $nombre_servicio = $_POST['nombre_servicio'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $precio = floatval($_POST['precio'] ?? 0);
    $categoria = $_POST['categoria'] ?? '';

    // Validar que los campos no estén vacíos
    if (empty($nombre_servicio) || empty($descripcion) || empty($precio) || empty($categoria)) {
        header("Location: ../View/agregar_servicio.php?msg=❌ Todos los campos son obligatorios.");
        exit();
    }

    // Llamar al modelo para guardar el servicio
    if (Servicio::agregarServicio($nombre_servicio, $descripcion, $precio, $categoria)) {
        header("Location: ../View/agregar_servicio.php?msg=✅ Servicio guardado exitosamente.");
    } else {
        header("Location: ../View/agregar_servicio.php?msg=❌ Error al guardar el servicio.");
    }
    exit();
}
?>