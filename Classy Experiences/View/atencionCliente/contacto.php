<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$usuarioActivo = isset($_SESSION['id']); // Verifica si hay un usuario activo
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Contacto - Atención al Cliente</title>
   <link rel="stylesheet" href="../../Css/atencion-cliente.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"
        integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <a class="logo" href="../View/index.php">
            <img src="../../img/classy.png" alt="logo">
            <h2 class="nombredelaempresa">Classy</h2>
        </a>
    
        <nav>
            
            <a href="../../View/index.php">Home</a>
            <a href="../../View/servicios.php">Servicios</a>
            <a href="../../View/conocenos.php">Conócenos</a>
            <a href="../../View/redes.php">Redes Sociales</a>
            <a href="../../View/reseñas/resenas.php">Reseñas</a>
                     <?php if (!$usuarioActivo): ?>
    <a href="../View/login/login.php">Iniciar Sesion</a>
<?php else: ?>
    <a href="../Controller/LogoutController.php">Cerrar sesión</a>
<?php endif; ?>
 <a href="../../View/carrito.php" class="carrito">
                <i class="fas fa-shopping-cart"></i>
                <span class="contador" id="contador-carrito">0</span> 
            </a>
            <a href= "../../view/perfil.php" >Perfil</a>
        </nav>
    </header>
    <center>
  <h2>Formulario de Atención al Cliente</h2>
  <form action="../atencionCliente/enviar_contacto.php" method="post">
    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="email">Correo electrónico:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="mensaje">Mensaje:</label><br>
    <textarea id="mensaje" name="mensaje" rows="5" required></textarea><br><br>

   <input type="submit" value="enviar" name="enviar">
  </form>
  </center>
 
</body>
</html>