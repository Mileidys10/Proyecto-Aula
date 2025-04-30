<?php
// Incluir el archivo de conexión a la base de datos
include('conexion.php');

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los valores del formulario
    $nombre_servicio = $_POST['nombre_servicio'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO servicios (nombre_servicio, descripcion, precio, categoria) 
            VALUES (?, ?, ?, ?)";

    // Preparar la consulta con la conexión
    if ($stmt = $conexion->prepare($sql)) {
        // Enlazar los parámetros con el tipo adecuado
        $stmt->bind_param("ssds", $nombre_servicio, $descripcion, $precio, $categoria);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Servicio guardado exitosamente.";
        } else {
            echo "Error al guardar el servicio: " . $stmt->error;
        }

        // Cerrar la sentencia
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conexion->error;
    }
}

// Cerrar la conexión
$conexion->close();
?>
