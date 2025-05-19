<?php
require_once __DIR__ . '/../Config/Conexion.php';

class Reseña {

    public function agregarReseña($nombre, $comentario, $puntuacion) {
        $conn = Conexion::conectar();

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
        $reseñas = [];
        while ($row = $resultado->fetch_assoc()) {
            $resena = new \Reseña();
            $resena->setId($row['id']);
            $resena->setNombre($row['nombre']);
            $resena->setComentario($row['comentario']);
            $resena->setPuntuacion($row['puntuacion']);
            $resena->setFecha($row['fecha']);
            $reseñas[] = $resena;
        }
        return $reseñas;
    }
}


?>