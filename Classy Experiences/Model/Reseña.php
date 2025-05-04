<?php
require_once __DIR__ . '/../Config/Conexion.php';

class Reseña {

    public function agregarReseña($nombre, $comentario, $puntuacion) {
        $conn = Conexion::conectar();

        // Cambiamos el formato de la fecha a Y-m-d
        $fecha = date("Y-m-d");
        $stmt = $conn->prepare("INSERT INTO resenas_usuarios(nombre, comentario, puntuacion, fecha) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $nombre, $comentario, $puntuacion, $fecha);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error al agregar reseña: " . $stmt->error);
            return false;
        }
    }

    public function obtenerReseñas() {
        $conn = Conexion::conectar();
        $resultado = $conn->query("SELECT * FROM resenas_usuarios ORDER BY fecha DESC");
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
?>