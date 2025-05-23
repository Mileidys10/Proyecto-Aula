
<?php
require_once __DIR__ . '/../../Controller/PerfilController.php'; 
require_once __DIR__ . '/../../Config/Conexion.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$usuarioActivo = isset($_SESSION['id']);

$conn = Conexion::conectar();

$nombre_usuario = $_SESSION['nombre']; 

$query = "SELECT comentario, puntuacion, fecha FROM resenas_usuarios WHERE nombre = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $nombre_usuario);
$stmt->execute();
$result = $stmt->get_result();
?>
<link rel="stylesheet" href="../../Css/perfil.css">
<link rel="stylesheet" href="../../Css/index-o.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"
    integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" crossorigin="anonymous"></script>

<header>
    <a class="logo" href="../index.php">
        <img src="../../img/classy.png" alt="logo">
        <h2 class="nombredelaempresa">Classy</h2>
    </a>
    <nav>
        <a href="../atencionCliente/contacto.php">Atención al cliente</a>
        <a href="../index.php">Home</a>
        <a href="../servicios.php">Servicios</a>
        <a href="../conocenos.php">Conócenos</a>
        <a href="../redes.php">Redes Sociales</a>
        <a href="../reseñas/resenas.php">Reseñas</a>
        <?php if (!$usuarioActivo): ?>
            <a href="../login/login.php">Iniciar Sesion</a>
        <?php else: ?>
            <a href="../../Controller/LogoutController.php" title="Cerrar sesión">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        <?php endif; ?>
        <a href="../carrito.php" class="carrito">
            <i class="fas fa-shopping-cart"></i>
            <span class="contador" id="contador-carrito">0</span> 
        </a>
        <a href="perfil.php" title="Perfil">
            <i class="fas fa-user"></i>
        </a>
    </nav>
</header>

<div class="perfil-container">
<?php
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
<form action="../../Controller/cambiar_contraseña.php" method="POST">
    <label>Contraseña Actual:</label>
    <input type="password" name="actual_pass" required><br>
    
    <label>Nueva Contraseña:</label>
    <input type="password" name="nueva_pass" required><br>
    
    <button type="submit">Actualizar</button>
</form>
<h2>Cambiar Correo</h2>
<form action="../../Controller/cambiar_gmail.php" method="POST">
    <label>Correo Actual:</label>
    <input type="text" name="actual_correo" required><br>
    
    <label>Nuevo Correo:</label>
    <input type="text" name="nuevo_correo" required><br>
    
    <button type="submit">Actualizar</button>
</form>
<h2>Cambiar Nombre</h2>
<form action="../../Controller/cambiar_nombreController.php" method="POST">
    <label>Nombre Actual:</label>
    <input type="text" name="actual_nombre" required><br>
    
    <label>Nuevo Nombre :</label>
    <input type="text" name="nuevo_nombre" required><br>
    
    <button type="submit">Actualizar</button>
</form>
</div>