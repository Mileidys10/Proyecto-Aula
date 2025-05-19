<?php
require_once __DIR__ . '../Model/Entity/Admin.php';
require_once __DIR__ . '../Config/Conexion.php';
class crudAdmin {
    public static function agregar(Admin $admin) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("INSERT INTO admin (id, cargo) VALUES (?, ?)");
        $stmt->bind_param(
            "is",
            $admin->getId(),
            $admin->getCargo()
        );
        return $stmt->execute();
    }
}
?>