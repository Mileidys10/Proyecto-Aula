<?php
require_once '../Config/Conexion.php';

class Servicio {
    public static function agregarServicio($nombre, $descripcion, $precio, $categoria) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("INSERT INTO servicios (nombre_servicio, descripcion, precio, categoria) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $nombre, $descripcion, $precio, $categoria);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error al guardar el servicio: " . $stmt->error);
            return false;
        }
    }
}
?>