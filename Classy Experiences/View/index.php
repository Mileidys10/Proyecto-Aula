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
    <title>Classy Experiences</title>
    <link rel="stylesheet" href="../Css/index-o.css">
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
                <span class="contador" id="contador-carrito">0</span> 
            </a>
        </nav>
    </header>
    

    <section id="hero">

        <h1>Classy Experiences</h1>
        <h2>Ten las vacaciones soñadas con el mayor lujo y comodidad</h2>
        <h3>Conoce la experiencia Classy</h3>

        <form action="#whoareus">
            
            <button>¡Descubrir cómo!</button>

        </form>
    </section>


    <section id="whoareus">
        <div class="container">
            <div class="image-container"></div>
            <h2>Somos <span class="color-acento">Classy Experiences</span></h2>
            <p>Descubre el verdadero lujo en Cartagena de Indias con <span class="color-acent2">Classy Experiences</span>. Somos tu puerta de entrada a experiencias únicas e inolvidables. Ofrecemos una amplia gama de servicios, desde alojamientos de ensueño en villas y hoteles boutique hasta excursiones privadas en yates de lujo y tours personalizados por la ciudad amurallada. Nuestro compromiso es brindarte un servicio excepcional y crear recuerdos que perdurarán en el tiempo</p>
        </div>
    </section>

    <section id="servicios">
    <div class="container">
        <h2>NUESTROS SERVICIOS</h2>
        <div class="servicos">
            <div class="cartas">
                <h3>Alojamiento</h3>
                <p>Alojamiento boutique con encanto colonial...</p>
                <a href="../View/servicios.php#alojamiento"><button>+ Info</button></a>
                <button class="agregar-carrito" data-nombre="Alojamiento" data-precio="150">Agregar al carrito</button>
            </div>
            <div class="cartas">
                <h3>Embarcaciones</h3>
                <p>Navega en catamarán por el Caribe...</p>
                <a href="../View/servicios.php#embarcaciones"><button>+ Info</button></a>
                <button class="agregar-carrito" data-nombre="Embarcaciones" data-precio="300">Agregar al carrito</button>
            </div>
            <div class="cartas">
                <h3>Tours</h3>
                <p>Descubre la magia de Cartagena...</p>
                <a href="../View/servicios.php#toures"><button>+ Info</button></a>
                <button class="agregar-carrito" data-nombre="Tour Isla" data-precio="250">Agregar al carrito</button>
            </div>
        </div>
    </div>
</section>



    <section id="redes" class="redes">
        <div class="container">
            <h2>Nuestras redes sociales</h2>
            <ul>
                <li class="wtt"><a href="https://walink.co/fd477e"target="_blank"><i class="fa-brands fa-whatsapp"> Whatsapp</i></a>
                </li>
                <li class="ig">
                    <a href="https://www.instagram.com/classyexperiences/" target="_blank">
                        <i class="fa-brands fa-instagram"> Instagram</i>
                    </a>
                </li>
                
                <li class="fb"><a href="https://www.facebook.com/profile.php?id=61554000185984"target="_blank"><i
                            class="fa-brands fa-facebook"> Facebook</i></a></li>
            </ul>
        </div>



    </section>




    <section class="touresymas">

        <h2>¿Estás preparado para tener las mejores vacaciones?</h2>
      <a href="../View/servicios.html"><button>!Saber cómo!</button></a> 

    </section>
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

</body>




<footer class="container">


    <img src="../Media/Bannerclassy.jpeg" alt="">
    <p>&copy; ClassyGroup 2025</p>
</footer>




</html>