<?php
require_once __DIR__ . '/../Entity/Conductor.php';
require_once __DIR__ . '/../../Config/Conexion.php';
class crudConductor {
    public static function agregar(Conductor $conductor) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("INSERT INTO conductor (id, licencia, vehiculo) VALUES (?, ?, ?)");
        $stmt->bind_param(
            "iss",
            $conductor->getId(),
            $conductor->getLicencia(),
            $conductor->getVehiculo()
        );
        return $stmt->execute();
    }
}
?>