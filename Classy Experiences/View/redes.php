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
            <img src="../Media/classy.png" alt="logo">
            <h2 class="nombredelaempresa">Classy</h2>
        </a>
    
        <nav>
            <a href="../View/index.php">Home</a>
            <a href="../View/servicios.php">Servicios</a>
            <a href="../View/conocenos.php">Conócenos</a>
            <a href="../View/redes.php">Redes Sociales</a>
            <a href="../View/resenas.php">Reseñas</a>
            <a href="../View/login.php">Iniciar Sesion</a>
            <?php if ($usuarioActivo): ?>
            <a href="../Controller/LogoutController.php">Cerrar sesión</a>
        <?php endif; ?>
        <a href="../View/carrito.php" class="carrito">
                <i class="fas fa-shopping-cart"></i>
                <span class="contador">3</span> 
            </a>
            </nav>
    </header>

<br><br><br><br><br>
<div class="contenedortopredes">
<div class="contenedor-redes">
   <a href="https://www.instagram.com/classyexperiences/" target="_blank"><div class="carta-red">
   
    <h1 class="itemname"><i class="fa-brands fa-instagram"></i> Instagram</h1>
        <img src="../Media/ig.png" alt="" class="ssred">
    </a> 
    
</div>

<a href="https://www.facebook.com/profile.php?id=61554000185984" target="_blank"><div class="carta-red">
    
    <h1 class="itemname">    <i
        class="fa-brands fa-facebook"></i>Facebook</h1>
    <img src="../Media/fb.png" alt="" class="ssred">
</a> 

</div>


<a href="https://walink.co/fd477e" target="_blank"><div class="carta-red">
    
    <h1 class="itemname"><i class="fa-brands fa-whatsapp"></i>Whatsapp</h1>
    <img src="../Media/wtt.png" alt="" class="ssred">
</a> 

</div>

</div>





</body>
</html>