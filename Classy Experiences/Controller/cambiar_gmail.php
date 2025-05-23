<?php
session_start();
include '../Config/conexion.php';
 $conn = Conexion::conectar();
$id_usuario = $_SESSION['id'];
$actual_correo = $_POST['actual_correo'];
$nuevo_correo = $_POST['nuevo_correo'];

// 1. Obtener el correo actual
$query = "SELECT email FROM usuarios WHERE id = ?";     
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$correo_actual = $user['email'];
// 2. Validar correo actual
if ($correo_actual != $actual_correo) {
    die("❌ El correo actual no es correcto.");
}
// 3. Verificar que el nuevo correo no sea igual al actual
if ($correo_actual == $nuevo_correo) {
    die("❌ El nuevo correo no puede ser igual al actual.");
}
// 4. Actualizar
$update = $conn->prepare("UPDATE usuarios SET email = ? WHERE id = ?");
$update->bind_param("si", $nuevo_correo, $id_usuario);
$update->execute();
if ($update->affected_rows > 0) {
    echo "✅ Correo actualizado correctamente.";
} else {
    echo "⚠️ No se pudo actualizar el correo.";
}














?>