<?php require_once __DIR__ . '/../../Controller/PerfilController.php'; ?>
<?php require_once __DIR__ . '/../../Config/Conexion.php';
$conn = Conexion::conectar();

$nombre_usuario = $_SESSION['nombre']; // Asegúrate de tener esto en la sesión

$query = "SELECT comentario, puntuacion, fecha FROM resenas_usuarios WHERE nombre = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $nombre_usuario);
$stmt->execute();
$result = $stmt->get_result();


echo "<h2>Mis Reseñas</h2>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>Comentario:</strong> {$row['comentario']}<br>";
        echo "<strong>Puntuación:</strong> {$row['puntuacion']}<br>";
        echo "<strong>Fecha:</strong> {$row['fecha']}</p><hr>";
    }
} else {
    echo "<p>No has dejado reseñas aún.</p>";
}
?>
<?php
$id_usuario = $_SESSION['id']; // Asegúrate de que el ID esté en la sesión
$query = "SELECT nombre, email, user_type, fecha_registro FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

echo "<h2>Mi Información</h2>";
echo "<p><strong>Tipo de Usuario:</strong> {$user['user_type']}</p>";
echo "<p><strong>Miembro desde:</strong> {$user['fecha_registro']}</p>";
echo "<p><strong>Nombre:</strong> {$user['nombre']}</p>";
echo "<p><strong>Email:</strong> {$user['email']}</p>";
?>
<h2>Cambiar Contraseña</h2>
<form action="../Controller/cambiar_contraseña.php" method="POST">
    <label>Contraseña Actual:</label>
    <input type="password" name="actual_pass" required><br>
    
    <label>Nueva Contraseña:</label>
    <input type="password" name="nueva_pass" required><br>
    
    <button type="submit">Actualizar</button>
</form>