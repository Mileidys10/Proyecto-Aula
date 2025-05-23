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