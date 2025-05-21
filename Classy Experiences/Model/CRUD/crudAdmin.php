<?php
require_once __DIR__ . '/../Entity/Admin.php';
require_once __DIR__ . '/../../Config/Conexion.php';

class crudAdmin {
    public static function agregar(Admin $admin) {
    $conn = Conexion::conectar();
    $stmt = $conn->prepare("INSERT INTO admin (id, cargo) VALUES (?, ?)");
    $id = $admin->getId();
    $cargo = $admin->getCargo();
    $stmt->bind_param(
        "is",
        $id,
        $cargo
    );
    return $stmt->execute();
}
}
?>