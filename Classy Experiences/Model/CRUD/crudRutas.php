<?php

require_once __DIR__ . '/../Rutas.php';
require_once __DIR__ . '/../../Config/Conexion.php';

class crudRutas {
    public static function agregar(Ruta $ruta) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("INSERT INTO rutas (nombre_ruta, descripcion, fecha, conductor_id, guia_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssii",
            $ruta->getNombreRuta(),
            $ruta->getDescripcion(),
            $ruta->getFecha(),
            $ruta->getConductorId(),
            $ruta->getGuiaId()
        );
        return $stmt->execute();
    }

    public static function obtenerTodas() {
        $conn = Conexion::conectar();
        $result = $conn->query("SELECT * FROM rutas");
        $rutas = [];
        while ($row = $result->fetch_assoc()) {
            $ruta = new Ruta();
            $ruta->setId($row['id']);
            $ruta->setNombreRuta($row['nombre_ruta']);
            $ruta->setDescripcion($row['descripcion']);
            $ruta->setFecha($row['fecha']);
            $ruta->setConductorId($row['conductor_id']);
            $ruta->setGuiaId($row['guia_id']);
            $rutas[] = $ruta;
        }
        return $rutas;
    }

    public static function obtenerPorId($id) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("SELECT * FROM rutas WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $ruta = new Ruta();
            $ruta->setId($row['id']);
            $ruta->setNombreRuta($row['nombre_ruta']);
            $ruta->setDescripcion($row['descripcion']);
            $ruta->setFecha($row['fecha']);
            $ruta->setConductorId($row['conductor_id']);
            $ruta->setGuiaId($row['guia_id']);
            return $ruta;
        }
        return null;
    }

    public static function editar(Ruta $ruta) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("UPDATE rutas SET nombre_ruta=?, descripcion=?, fecha=?, conductor_id=?, guia_id=? WHERE id=?");
        $stmt->bind_param("sssiii",
            $ruta->getNombreRuta(),
            $ruta->getDescripcion(),
            $ruta->getFecha(),
            $ruta->getConductorId(),
            $ruta->getGuiaId(),
            $ruta->getId()
        );
        return $stmt->execute();
    }

    public static function eliminar($id) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("DELETE FROM rutas WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>