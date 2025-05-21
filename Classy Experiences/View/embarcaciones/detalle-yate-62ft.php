""
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yate 62ft</title>
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
            <a href="../../View/index.php">Home</a>
            <a href="../../View/servicios.php">Servicios</a>
            <a href="../../View/conocenos.php">Conócenos</a>
            <a href="../../View/redes.php">Redes Sociales</a>
            <a href="../../View/resenas.php">Reseñas</a>
            <a href="../../View/login.php">Iniciar Sesion</a>
            <a href="../../Controller/LogoutController.php">Cerrar sesión</a>
            <a href="../../View/carrito.php" class="carrito">
                <i class="fas fa-shopping-cart"></i>
                <span class="contador" id="contador-carrito">0</span> 
            </a>
        </nav>
    </header>

    <main class="contenedor">
        <section class="tarjeta-detalle-producto">
            <figure class="contenedor-imagen">
                <img src="../../img/botes/yate62ft.jpg" alt="Yate 62ft" style="width: 100%; border-radius: 15px;">
            </figure>

            <div class="informacion-producto">  
                <h2 class="titulo-secundario">Yate 62ft</h2><br>
                <p class="descripcion">
                    Vive una experiencia de lujo en altamar con el Yate 62ft. Disfruta de sus amplias instalaciones, perfectas para navegar en las aguas cristalinas del Caribe colombiano. 
                    Este yate cuenta con todas las comodidades necesarias para un viaje inolvidable, incluyendo espaciosas cabinas, una zona de entretenimiento y un diseño elegante y moderno.
                </p>
                <br>
                <p class="precio">
                    <strong>Precio por día:</strong> $2.500.000 COP
                </p>

                <button class="boton-principal agregar-carrito" data-nombre="Yate 62ft" data-precio="2500000">
                    <i class="fa-solid fa-cart-plus"></i> Agregar al carrito
                </button>
            </div>
        </section>
    </main>

    <footer class="contenedor">
        <p>&copy; 2025 Cartagena Luxury. Todos los derechos reservados.</p>
    </footer>

    <script src="../JS/servicios_carrito.js"></script>
</body>
</html>

