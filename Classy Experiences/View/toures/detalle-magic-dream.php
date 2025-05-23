<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$usuarioActivo = isset($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magic Dream Island</title>
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
                <a href="../../View/login/login.php">Iniciar Sesión</a>
            <?php else: ?>
                <a href="../../Controller/LogoutController.php" title="Cerrar sesión"><i class="fas fa-sign-out-alt"></i></a>
            <?php endif; ?>
            <a href="../../View/carrito.php" class="carrito"><i class="fas fa-shopping-cart"></i><span class="contador" id="contador-carrito">0</span></a>
            <a href="../../view/login/perfil.php" title="Perfil"><i class="fas fa-user"></i></a>
        </nav>
    </header>

    <main class="contenedor">
        <section class="tarjeta-detalle-producto">
            <figure class="contenedor-imagen">
                <img src="../../img/toures/islaparadisiaca.jpg" alt="Magic Dream Island" style="width: 100%; border-radius: 15px;">
            </figure>

            <div class="informacion-producto">
                <h2 class="titulo-secundario">Magic Dream Island</h2><br>
                <p class="descripcion">
                    Escápate a una isla privada con ambiente exclusivo. Este plan te brinda acceso a un beach club de lujo con piscina, bar y zonas de descanso únicas.
                    <ul class="lista-detalle">
                        <li>Transporte marítimo incluido</li>
                        <li>Acceso a todas las instalaciones</li>
                        <li>Zona VIP y atención personalizada</li>
                        <li>Cóctel de bienvenida</li>
                    </ul>
                </p><br>
                <p class="precio">
                    <strong>Precio:</strong> $420.000 COP por persona
                </p>

                <button class="agregar-carrito boton-principal" data-nombre="Magic Dream Island" data-precio="320000">
                    <i class="fa-solid fa-cart-plus"></i> Agregar al carrito
                </button>
            </div>
        </section>
    </main>

    <footer class="contenedor">
        <p>&copy; 2025 Cartagena Luxury. Todos los derechos reservados.</p>
    </footer>

    <script>
        var USER_ID = <?php echo isset($_SESSION['id']) ? (int)$_SESSION['id'] : 0; ?>;
        if (USER_ID > 0) {
            localStorage.removeItem('carrito_usuario_0');
        }
    </script>
    <script src="../../JS/carrito.js"></script>
</body>
</html>
