<?php
require_once __DIR__ . '/../../Config/Conexion.php';

class crudEstadisticas {
    public static function reservasMes($mes, $anio) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("SELECT COUNT(*) as total FROM facturas WHERE MONTH(fecha) = ? AND YEAR(fecha) = ?");
        $stmt->bind_param("ii", $mes, $anio);
        $stmt->execute();
        $total = $stmt->get_result()->fetch_assoc()['total'] ?? 0;
        $stmt->close();
        return $total;
    }

    public static function ingresosMes($mes, $anio) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("SELECT COALESCE(SUM(total), 0) as total FROM facturas WHERE MONTH(fecha) = ? AND YEAR(fecha) = ?");
        $stmt->bind_param("ii", $mes, $anio);
        $stmt->execute();
        $total = $stmt->get_result()->fetch_assoc()['total'] ?? 0;
        $stmt->close();
        return $total;
    }

    public static function totalReservas() {
        $conn = Conexion::conectar();
        $sql = "SELECT COUNT(*) as total FROM facturas";
        $result = $conn->query($sql);
        return $result->fetch_assoc()['total'] ?? 0;
    }

    public static function totalIngresos() {
        $conn = Conexion::conectar();
        $sql = "SELECT COALESCE(SUM(total), 0) as total FROM facturas";
        $result = $conn->query($sql);
        return $result->fetch_assoc()['total'] ?? 0;
    }
}