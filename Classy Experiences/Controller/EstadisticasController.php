<?php
require_once '../Config/Conexion.php';

class EstadisticasController {
    public static function obtenerEstadisticas() {
        $conn = Conexion::conectar();

        // Total de servicios publicados
        $resServicios = $conn->query("SELECT COUNT(*) AS total FROM servicios");
        $totalServicios = $resServicios->fetch_assoc()['total'];

        // Total de imágenes subidas
        $resImagenes = $conn->query("SELECT COUNT(*) AS total FROM imagenes_servicio");
        $totalImagenes = $resImagenes->fetch_assoc()['total'];

        return [
            'totalServicios' => $totalServicios,
            'totalImagenes' => $totalImagenes
        ];
    }
}
?>



