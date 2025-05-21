<?php
session_start();
include '../Config/conexion.php';

$conn = Conexion::conectar();

$id_usuario = $_SESSION['id'];
$actual_pass = $_POST['actual_pass'];
$nueva_pass = $_POST['nueva_pass'];

// 1. Obtener la contraseña actual hasheada
$query = "SELECT password FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$hash_actual = $user['password'];

// 2. Validar contraseña actual
if (!password_verify($actual_pass, $hash_actual)) {
    die("❌ La contraseña actual no es correcta.");
}

// 3. Verificar que la nueva contraseña no sea igual a la actual
if (password_verify($nueva_pass, $hash_actual)) {
    die("❌ La nueva contraseña no puede ser igual a la actual.");
}

// 4. Hashear y actualizar
$nueva_hash = password_hash($nueva_pass, PASSWORD_DEFAULT);
$update = $conn->prepare("UPDATE usuarios SET password = ? WHERE id = ?");
$update->bind_param("si", $nueva_hash, $id_usuario);
$update->execute();

if ($update->affected_rows > 0) {
    echo "✅ Contraseña actualizada correctamente.";
} else {
    echo "⚠️ No se pudo actualizar la contraseña.";
}
?>