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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palmarito Beach</title>
    <link rel="stylesheet" href="../../Css/estilo-servicios.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <header class="contenedor">
        <a class="logo" href="../../View/index.php">
            <img src="../../img/classy.png" alt="logo">
            <h2 class="nombredelaempresa">Classy</h2>
        </a>
               <nav>
            <a href="../../View/atencionCliente/contacto.php">Atención al cliente</a>
            <a href="../../View/index.php">Home</a>
            <a href="../../View/servicios.php">Servicios</a>
            <a href="../../View/conocenos.php">Conócenos</a>
            <a href="../../View/redes.php">Redes Sociales</a>
            <a href="../../View/reseñas/resenas.php">Reseñas</a>
                     <?php if (!$usuarioActivo): ?>
    <a href="../../View/login/login.php">Iniciar Sesion</a>
<?php else: ?>
    <a href="../../Controller/LogoutController.php" title="Cerrar sesión">
        <i class="fas fa-sign-out-alt"></i>
    </a>
<?php endif; ?>
<a href="../../View/carrito.php" class="carrito">
    <i class="fas fa-shopping-cart"></i>
    <span class="contador" id="contador-carrito">0</span> 
</a>
<a href="../../view/login/perfil.php" title="Perfil">
    <i class="fas fa-user"></i>
</a>
        </nav>
    </header>

    <main class="contenedor">
        <section class="tarjeta-detalle-producto">
            <figure class="contenedor-imagen">
                <img src="../../img/alojamientos/299801132.jpg" alt="Palmarito Beach" style="width: 100%; border-radius: 15px;">
            </figure>

            <div class="informacion-producto">
                <h2 class="titulo-secundario">Palmarito Beach</h2><br>
              <p class="descripcion">
    Vive la mejor experiencia de playa en Palmarito Beach, un exclusivo club frente al mar con ambiente tropical y moderno.
    Disfruta de la brisa caribeña mientras saboreas cócteles exóticos y comida típica con un toque de lujo.
    Un lugar ideal para pasar el día, tomar el sol y gozar de una atención personalizada en Cartagena.
    <ul class="lista-detalle">
        <li>Camas y cabañas frente al mar</li>
        <li>Bar y restaurante con menú variado</li>
        <li>Música en vivo y DJs</li>
        <li>Piscina de agua salada</li>
        <li>Zonas VIP y servicio a la mesa</li>
    </ul>
</p>

                <br>
                <p class="precio">
                    <strong>Precio por noche:</strong> $500.000 COP
                </p>
                <button class="boton-principal agregar-carrito" data-nombre="Palmarito Beach" data-precio="500000">
                    <i class="fa-solid fa-cart-plus"></i> Agregar al carrito
                </button>
            </div>
        </section>
    </main>

    <footer class="contenedor">
        <p>&copy; 2025 Cartagena Luxury. Todos los derechos reservados.</p>
    </footer>

    <!-- Script para agregar al carrito -->
 <script src="../../JS/carrito.js"></script>

</html>
