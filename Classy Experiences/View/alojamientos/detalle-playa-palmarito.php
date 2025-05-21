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
   <script>
    document.addEventListener('DOMContentLoaded', () => {
        const botones = document.querySelectorAll('.agregar-carrito');
        const contadorCarrito = document.getElementById('contador-carrito');

        // Cargar la cantidad del carrito al iniciar
        const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
        contadorCarrito.textContent = carrito.length;

        botones.forEach(btn => {
            btn.addEventListener('click', () => {
                const nombre = btn.getAttribute('data-nombre');
                const precio = parseFloat(btn.getAttribute('data-precio'));

                const servicio = { nombre, precio };
                let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

                const existe = carrito.some(item => item.nombre === servicio.nombre);
                if (existe) {
                    alert(`"${nombre}" ya está en el carrito.`);
                } else {
                    carrito.push(servicio);
                    localStorage.setItem('carrito', JSON.stringify(carrito));
                    alert(`"${nombre}" agregado al carrito.`);
                }

                // Actualizar el contador
                contadorCarrito.textContent = carrito.length;
            });
        });
    });
</script>

</html>
