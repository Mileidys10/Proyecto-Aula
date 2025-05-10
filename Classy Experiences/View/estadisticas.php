<?php
session_start();

require_once '../Controller/EstadisticasController.php';

//$estadisticas = EstadisticasController::obtenerEstadisticas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadísticas del sistema</title>
    <link rel="stylesheet" href="../Css/dashboard.css">
</head>
<body>
    <header>
        <h1>Estadísticas del sistema</h1>
    </header>
    <main>
        <ul>
            <li>Total de servicios publicados: <?php echo $estadisticas['totalServicios']; ?></li>
            <li>Total de imágenes subidas: <?php echo $estadisticas['totalImagenes']; ?></li>
        </ul>
    </main>
</body>
</html>