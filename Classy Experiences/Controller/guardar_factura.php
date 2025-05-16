<?php
include('../config/conexion.php'); // Ajusta el nombre si tu archivo es distinto

// Recibir datos JSON del body
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'No se recibieron datos']);
    exit;
}

$nombre_cliente = $data['nombre_cliente'] ?? '';
$fecha = date('Y-m-d H:i:s');
$items = $data['items'] ?? [];

if (empty($nombre_cliente) || empty($items)) {
    http_response_code(400);
    echo json_encode(['error' => 'Faltan datos obligatorios']);
    exit;
}

// Prepara e inserta cada servicio vendido en la tabla facturas
foreach ($items as $item) {
    $id_servicio = $item['id'] ?? 0;  // Debes mandar el id del servicio en el carrito para esto
    $precio = $item['precio'] ?? 0;
    $cantidad = $item['cantidad'] ?? 1;

    $total = $precio * $cantidad;

    $stmt = $conexion->prepare("INSERT INTO facturas (id_servicio, nombre_cliente, fecha, cantidad, total) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issid", $id_servicio, $nombre_cliente, $fecha, $cantidad, $total);

    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode(['error' => 'Error al guardar la factura: ' . $stmt->error]);
        exit;
    }
}

$stmt->close();
$conexion->close();

echo json_encode(['success' => true]);
?>
