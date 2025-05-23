<?php
session_start();
include '../Config/conexion.php';
$conn = Conexion::conectar();
$id_usuario = $_SESSION['id']; // Asegúrate de que el ID esté en la sesión
$actual_nombre = $_POST['actual_nombre'];
$nuevo_nombre = $_POST['nuevo_nombre'];

// 1. Obtener el nombre actual
$query = "SELECT nombre FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$nombre_actual = $user['nombre'];
// 2. Validar nombre actual
if ($nombre_actual != $actual_nombre) {
    die("❌ El nombre actual no es correcto.");
}
// 3. Verificar que el nuevo nombre no sea igual al actual
if ($nombre_actual == $nuevo_nombre) {
    die("❌ El nuevo nombre no puede ser igual al actual.");
}
// 4. Actualizar
$update = $conn->prepare("UPDATE usuarios SET nombre = ? WHERE id = ?");
$update->bind_param("si", $nuevo_nombre, $id_usuario);
$update->execute();
if ($update->affected_rows > 0) {
    echo "✅ Nombre actualizado correctamente.";
} else {
    echo "⚠️ No se pudo actualizar el nombre.";
}




?>