<?php
// filepath: c:\xampp\htdocs\Classy\View\admin\mostrar_facturas.php
require_once '../../Config/Conexion.php';

// Consulta todas las facturas
$conn = Conexion::conectar();
$sql = "SELECT id, nombre_cliente, fecha, cantidad, total FROM facturas ORDER BY fecha DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas - Panel de Administración</title>
    <link rel="stylesheet" href="../../Css/dashboard.css">
    <style>
        body {
            background-color: #f9f9f9;
            margin-top: 80px;
        }
        .table-container {
            max-width: 1200px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.07);
            padding: 32px 18px;
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        th, td {
            padding: 12px 10px;
            text-align: left;
        }
        th {
            background: #222;
            color: #fff;
            font-weight: 600;
            font-size: 1.05em;
            border-bottom: 2px solid #c7a17a;
        }
        tr:nth-child(even) {
            background: #f7f7f7;
        }
        tr:hover {
            background: #f0e6d2;
        }
        .btn, a.btn {
            padding: 10px 22px;
            background: #111;
            color: #fff !important;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 1em;
            cursor: pointer;
            margin-top: 10px;
            text-decoration: none;
            transition: background 0.2s;
            display: inline-block;
        }
        .btn:hover, a.btn:hover {
            background: #ff6347;
        }
        h1 {
            color: #222;
            margin: 40px 0 28px 0;
            text-align: center;
            font-size: 2.2em;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../../img/classy.png" alt="Logo"> 
            <span>Panel de Administración</span>
        </div>
        <nav>
            <a href="admin.php">Inicio</a>
            <a href="mostrarfacturas.php">Facturas</a>
            <a href="registro_usuarios_admin.php">Registrar Usuario</a>
            <a href="mostrar_usuario.php">Mostrar Usuarios</a>
            <a href="../../View/rutas/adminRutas.php">Rutas</a>
            <a href="../../Controller/LogoutController.php">Cerrar sesión</a>
        </nav>
    </header>

    <h1>Facturas</h1>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['nombre_cliente']) ?></td>
                            <td><?= htmlspecialchars($row['fecha']) ?></td>
                            <td><?= htmlspecialchars($row['cantidad']) ?></td>
                            <td>$<?= number_format($row['total'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center;">No hay facturas registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="admin.php" class="btn">Volver al Panel</a>
    </div>
</body>
</html>