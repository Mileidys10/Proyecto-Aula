<?php
// filepath: c:\xampp\htdocs\Classy\View\admin\estadisticas.php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header("Location: login.php?msg=¡Debes iniciar sesión como administrador!");
    exit;
}

require_once '../../Controller/EstadisticasController.php';
$estadisticas = EstadisticasController::obtenerEstadisticas();

// Para la gráfica y tabla: obtener reservas e ingresos de los últimos 6 meses
require_once '../../Model/CRUD/crudEstadisticas.php';
$meses = [];
$reservasPorMes = [];
$ingresosPorMes = [];
for ($i = 5; $i >= 0; $i--) {
    $mes = date('n', strtotime("-$i month"));
    $anio = date('Y', strtotime("-$i month"));
    $meses[] = date('M Y', strtotime("-$i month"));
    $reservasPorMes[] = crudEstadisticas::reservasMes($mes, $anio);
    $ingresosPorMes[] = crudEstadisticas::ingresosMes($mes, $anio);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadísticas - Panel de Administración</title>
    <link rel="stylesheet" href="../../Css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .estadisticas-container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.07);
            padding: 32px 18px;
        }
        .estadisticas-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 32px;
            justify-content: space-between;
            margin-bottom: 32px;
        }
        .estadistica-card {
            flex: 1 1 220px;
            background: #f7f7f7;
            border-radius: 8px;
            padding: 24px 18px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .estadistica-card h3 {
            margin: 0 0 10px 0;
            color: #ff6347;
            font-size: 1.2em;
        }
        .estadistica-card p {
            font-size: 2em;
            font-weight: bold;
            color: #222;
        }
        .tabla-resumen {
            width: 100%;
            border-collapse: collapse;
            margin-top: 24px;
        }
        .tabla-resumen th, .tabla-resumen td {
            padding: 10px 8px;
            text-align: left;
        }
        .tabla-resumen th {
            background: #222;
            color: #fff;
        }
        .tabla-resumen tr:nth-child(even) {
            background: #f7f7f7;
        }
        .grafica-container {
            margin: 40px 0;
        }
    </style>
</head>
<body>
    <header>
        <!-- ...tu header y nav aquí... -->
    </header>
    <div class="estadisticas-container">
        <h1>Estadísticas Generales</h1>
        <div class="estadisticas-grid">
            <div class="estadistica-card">
                <h3>Ventas este mes</h3>
                <p><?= $estadisticas['reservasMes'] ?></p>
            </div>
            <div class="estadistica-card">
                <h3>Ingresos este mes</h3>
                <p>$<?= number_format($estadisticas['ingresosMes'], 0, ',', '.') ?></p>
            </div>
            <div class="estadistica-card">
                <h3>Total de ventas</h3>
                <p><?= $estadisticas['totalReservas'] ?></p>
            </div>
            <div class="estadistica-card">
                <h3>Total de ingresos</h3>
                <p>$<?= number_format($estadisticas['totalIngresos'], 0, ',', '.') ?></p>
            </div>
        </div>

        <h2>Resumen de los últimos 6 meses</h2>
        <table class="tabla-resumen">
            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Servicios</th>
                    <th>Ingresos</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($meses); $i++): ?>
                <tr>
                    <td><?= htmlspecialchars($meses[$i]) ?></td>
                    <td><?= htmlspecialchars($reservasPorMes[$i]) ?></td>
                    <td>$<?= number_format($ingresosPorMes[$i], 0, ',', '.') ?></td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <div class="grafica-container">
            <canvas id="graficaEstadisticas"></canvas>
        </div>
    </div>
    <script>
        const ctx = document.getElementById('graficaEstadisticas').getContext('2d');
        const grafica = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($meses) ?>,
                datasets: [
                    {
                        label: 'Servicios',
                        data: <?= json_encode($reservasPorMes) ?>,
                        backgroundColor: 'rgba(255,99,71,0.7)'
                    },
                    {
                        label: 'Ingresos',
                        data: <?= json_encode($ingresosPorMes) ?>,
                        backgroundColor: 'rgba(60,141,188,0.7)'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Ventas e Ingresos por Mes' }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</body>
</html>