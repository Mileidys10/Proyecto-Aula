<?php
session_start();
require_once __DIR__ . '/../../Config/Conexion.php';

if (!isset($_SESSION['id']) || !in_array($_SESSION['tipo_usuario'], ['conductor', 'guia_turistico'])) {
    // Redirigir si no es conductor ni guía
    header("Location: ../index.php");
    exit;
}

$conn = Conexion::conectar();
$id_usuario = $_SESSION['id'];
$user_type = $_SESSION['tipo_usuario'];

// Consulta según el tipo de usuario
if ($user_type === 'conductor') {
    $query = "SELECT * FROM rutas WHERE conductor_id = ?";
} else {
    $query = "SELECT * FROM rutas WHERE guia_id = ?";
}

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Rutas</title>
    <link rel="stylesheet" href="../../Css/estilo-servicios.css">

    <style>

        /* ==== ESTILO PARA misrutas.php ==== */

body {
    background: #f9f9f9;
    color: #222;
    font-family: 'Segoe UI', Arial, sans-serif;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    margin-top: 36px;
    color: #ff6347;
    font-size: 2.2em;
    letter-spacing: 1px;
    font-weight: 700;
}

table {
    margin: 40px auto 0 auto;
    border-collapse: collapse;
    width: 90%;
    max-width: 900px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.07);
    overflow: hidden;
}

th, td {
    padding: 16px 12px;
    text-align: left;
}

th {
    background: #ff6347;
    color: #fff;
    font-size: 1.1em;
    font-weight: 600;
    border-bottom: 2px solid #e2c29b;
}

tr:nth-child(even) {
    background: #f7f7f7;
}

tr:hover {
    background: #ffe5dc;
    transition: background 0.2s;
}

td {
    font-size: 1em;
    color: #333;
}

p {
    text-align: center;
    margin-top: 60px;
    font-size: 1.2em;
    color: #888;
}

@media (max-width: 700px) {
    table, th, td {
        font-size: 0.97em;
    }
    table {
        width: 99vw;
    }
    th, td {
        padding: 10px 6px;
    }
}
    </style>
</head>
<body>
    <h1>Mis Rutas</h1>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Ruta</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($ruta = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($ruta['id']) ?></td>
                        <td><?= htmlspecialchars($ruta['nombre_ruta']) ?></td>
                        <td><?= htmlspecialchars($ruta['descripcion']) ?></td>
                        <td><?= htmlspecialchars($ruta['fecha']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No tienes rutas asignadas.</p>
    <?php endif; ?>
</body>
</html>