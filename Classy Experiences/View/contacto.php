<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Contacto - Atención al Cliente</title>
   <link rel="stylesheet" href="../Css/resenas.css">
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
 <a href="../View/carrito.php" class="carrito">
                <i class="fas fa-shopping-cart"></i>
                <span class="contador" id="contador-carrito">0</span> 
            </a>
        </nav>
    </header>
    <center>
  <h2>Formulario de Atención al Cliente</h2>
  <form action="../View/enviar_contacto.php" method="post">
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