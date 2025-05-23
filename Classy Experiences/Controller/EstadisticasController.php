<?php

require_once __DIR__ . '/../Model/CRUD/crudEstadisticas.php';

class EstadisticasController {
    public static function obtenerEstadisticas() {
        $mesActual = date('n');
        $anioActual = date('Y');
        return [
            'reservasMes' => crudEstadisticas::reservasMes($mesActual, $anioActual),
            'ingresosMes' => crudEstadisticas::ingresosMes($mesActual, $anioActual),
            'totalReservas' => crudEstadisticas::totalReservas(),
            'totalIngresos' => crudEstadisticas::totalIngresos(),
        ];
    }
}