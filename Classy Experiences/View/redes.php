<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$usuarioActivo = isset($_SESSION['id']); // Verifica si hay un usuario activo
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redes Sociales - Classy Experiences</title>
    <link rel="stylesheet" href="../Css/redes-sociales.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"
    integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" crossorigin="anonymous"></script>

</head>
<body>
    
  <header>
        <a class="logo" href="../View/index.php">
            <img src="../img/classy.png" alt="logo">
            <h2 class="nombredelaempresa">Classy</h2>
        </a>
    
         <nav>
        
            <a href="../View/atencionCliente/contacto.php">Atención al cliente</a>
            <a href="../View/index.php">Home</a>
            <a href="../View/servicios.php">Servicios</a>
            <a href="../View/conocenos.php">Conócenos</a>
            <a href="../View/redes.php">Redes Sociales</a>
            <a href="../View/reseñas/resenas.php">Reseñas</a>
                     <?php if (!$usuarioActivo): ?>
    <a href="../View/login/login.php">Iniciar Sesion</a>
<?php else: ?>
    <a href="../Controller/LogoutController.php" title="Cerrar sesión">
        <i class="fas fa-sign-out-alt"></i>
    </a>
<?php endif; ?>
<a href="../View/carrito.php" class="carrito">
    <i class="fas fa-shopping-cart"></i>
    <span class="contador" id="contador-carrito">0</span> 
</a>
<a href="../View/login/perfil.php" title="Perfil">
    <i class="fas fa-user"></i>
</a>
        </nav>
    </header>

<br><br><br><br><br>
<div class="contenedortopredes">
<div class="contenedor-redes">
   <a href="https://www.instagram.com/classyexperiences/" target="_blank"><div class="carta-red">
   
    <h1 class="itemname"><i class="fa-brands fa-instagram"></i> Instagram</h1>
        <img src="../img/ig.png" alt="" class="ssred">
    </a> 
    
</div>

<a href="https://www.facebook.com/profile.php?id=61554000185984" target="_blank"><div class="carta-red">
    
    <h1 class="itemname">    <i
        class="fa-brands fa-facebook"></i>Facebook</h1>
    <img src="../img/fb.png" alt="" class="ssred">
</a> 

</div>


<a href="https://walink.co/fd477e" target="_blank"><div class="carta-red">
    
    <h1 class="itemname"><i class="fa-brands fa-whatsapp"></i>Whatsapp</h1>
    <img src="../img/wtt.png" alt="" class="ssred">
</a> 

</div>

</div>



<script>
    var USER_ID = <?php echo isset($_SESSION['id']) ? (int)$_SESSION['id'] : 0; ?>;
    if (USER_ID > 0) {
        localStorage.removeItem('carrito_usuario_0');
    }
</script>
 <script src="../JS/carrito.js"></script>
</body>
</html>