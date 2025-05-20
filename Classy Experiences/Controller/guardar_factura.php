<?php
header('Content-Type: application/json');
include('../config/conexion.php');

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'No se recibieron datos o JSON inválido']);
    exit;
}

$nombre_cliente = $data['nombre_cliente'] ?? '';
$items = $data['items'] ?? [];

if (empty($nombre_cliente) || empty($items)) {
    http_response_code(400);
    echo json_encode(['error' => 'Faltan datos obligatorios']);
    exit;
}

$conexion = Conexion::conectar();

foreach ($items as $item) {
    $id_servicio = $item['id'] ?? 0;
    $precio = $item['precio'] ?? 0;
    $cantidad = $item['cantidad'] ?? 1;

    $total = $precio * $cantidad;

    $stmt = $conexion->prepare("INSERT INTO facturas (id_servicio, nombre_cliente, fecha, cantidad, total) VALUES (?, ?, NOW(), ?, ?)");
    if (!$stmt) {
        http_response_code(500);
        echo json_encode(['error' => 'Error en la consulta: ' . $conexion->error]);
        exit;
    }
    $stmt->bind_param("isid", $id_servicio, $nombre_cliente, $cantidad, $total);

    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode(['error' => 'Error al guardar la factura: ' . $stmt->error]);
        exit;
    }
}

$stmt->close();
$conexion->close();

echo json_encode(['success' => true]);
