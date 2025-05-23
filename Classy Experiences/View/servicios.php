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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios - Classy</title>
    <link rel="stylesheet" href="../Css/servicios-pa.css">
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

  
    <main>
    
        <section class="container container-intro">
            <br><br>
            <h1 class="heading-1">Nuestros Servicios</h1>
            <br>
            <p>Vive la magia de Cartagena con nuestros servicios de lujo. Explora islas paradisíacas, relájate en playas de ensueño, disfruta de la gastronomía local en restaurantes exclusivos o celebra una ocasión especial con una pedida de mano inolvidable. Ofrecemos una amplia gama de actividades para que tu viaje sea único.</p>
        </section>


        <section class="container top-categories">
            <h2 class="heading-2">Categorías</h2>
            <div class="container-categories">
                <article class="card-category category-alojamiento" ><a href="#alojamiento" >
                    <p>Alojamiento</p>
                </a>
                </article>
                <article class="card-category category-embarcaciones">     <a href="#embarcaciones">
                    <p>Embarcaciones</p>
                </a>
                </article>
                <article class="card-category category-toures"><a href="#toures">
                    <p>Toures y Planes</p>
                </a>
                </article>
            </div>
        </section>


        <section class="container top-products">


            <section class="container top-products">
                <h2 id="alojamiento" class="heading-2">Alojamientos destacados</h2>
                <p>Sumérgete en el lujo colonial de Cartagena. Nuestras exclusivas villas y hoteles boutique te
                    transportarán a otra época, combinando la elegancia del pasado con las comodidades más modernas.
                    Disfruta de vistas panorámicas al mar Caribe, piscinas privadas, servicio personalizado y una
                    gastronomía exquisita. Cada rincón está diseñado para que te sientas como en casa, pero con un toque
                    de realeza.</p>
                <div class="container-products">

                <a href="../View/alojamientos/detalle-isla-mangata.php" class="card-link">
                    <article class="card-product">
                        <figure class="container-img">
                            <img src="../img/alojamientos/mangata.jpg" alt="Isla Mangata">
                            <figcaption class="itemname">Isla Mangata</figcaption>
                        </figure>
                        <div class="button-group">
                            <button><i class="fa-regular fa-eye"></i></button>
                            <button><i class="fa-regular fa-heart"></i></button>
                            <button><i class="fa-solid fa-code-compare"></i></button>
                        </div>
                    </article>
                    </a>

                    <a href="../View/alojamientos/detalle-playa-palmarito.php" class="card-link">
                    <article class="card-product">
                        <figure class="container-img">
                            <img src="../img/alojamientos/palmarito.jpg" alt="Palmarito Beach">
                            <figcaption class="itemname">Palmarito Beach</figcaption>
                        </figure>
                        <div class="button-group">
                            <button><i class="fa-regular fa-eye"></i></button>
                            <button><i class="fa-regular fa-heart"></i></button>
                            <button><i class="fa-solid fa-code-compare"></i></button>
                        </div>
                    </article>
                    </a>                    
                    
                    <a href="../View/alojamientos/detalle-apto-ferrara.php" class="card-link">
                    <article class="card-product">
                        <figure class="container-img">
                            <img src="../img/alojamientos/ferrara.JPG" alt="Apartamento Ferrara">
                            <figcaption class="itemname">Apto Ferrara</figcaption>
                        </figure>
                        <div class="button-group">
                            <button><i class="fa-regular fa-eye"></i></button>
                            <button><i class="fa-regular fa-heart"></i></button>
                            <button><i class="fa-solid fa-code-compare"></i></button>
                        </div>
                    </article>
                    </a>

                    <a href="../View/alojamientos/detalle-casa-baru.php" class="card-link">
                    <article class="card-product">
                        <figure class="container-img">
                            <img src="../img/alojamientos/CasaBaruLaPaz.jpg" alt="Casa Baru La Paz">
                            <figcaption class="itemname">Casa Baru La Paz</figcaption>
                        </figure>
                        <div class="button-group">
                            <button><i class="fa-regular fa-eye"></i></button>
                            <button><i class="fa-regular fa-heart"></i></button>
                            <button><i class="fa-solid fa-code-compare"></i></button>
                        </div>
                    </article>
                    </a>
                </div>
            </section>

            <section class="container top-products">
                <h2 id="embarcaciones" class="heading-2">Embarcaciones Destacadas</h2>
                <p>Navega por las cristalinas aguas del Caribe a bordo de nuestros yates de lujo. Disfruta de un día
                    inolvidable explorando islas paradisíacas, snorkel en arrecifes de coral, pesca deportiva o
                    simplemente relájate en la cubierta tomando el sol. Nuestros yates están equipados con todo lo
                    necesario para que tu experiencia sea perfecta: amplias cabinas, personal altamente capacitado y una
                    gastronomía gourmet.
                </p>
                <div class="container-products">
                   
                     <a href="../View/embarcaciones/detalle-yate-62ft.php" class="card-link">
            <article class="card-product">
                <figure class="container-img">
                    <img src="../img/botes/yate62ft.jpg" alt="Yate 62 FT">
                    <figcaption class="itemname">Yate 62 FT</figcaption>
                </figure>
                <div class="button-group">
                    <button><i class="fa-regular fa-eye"></i></button>
                    <button><i class="fa-regular fa-heart"></i></button>
                    <button><i class="fa-solid fa-code-compare"></i></button>
                </div>
            </article>
        </a>

        <a href="../View/embarcaciones/detalle-yate-ambar.php" class="card-link">
            <article class="card-product">
                <figure class="container-img">
                    <img src="../img/botes/yateambar.jpg" alt="Yate Ambar">
                    <figcaption class="itemname">Yate Ambar</figcaption>
                </figure>
                <div class="button-group">
                    <button><i class="fa-regular fa-eye"></i></button>
                    <button><i class="fa-regular fa-heart"></i></button>
                    <button><i class="fa-solid fa-code-compare"></i></button>
                </div>
            </article>
        </a>

        <a href="../View/embarcaciones/detalle-catamaran-lagoon.php" class="card-link">
            <article class="card-product">
                <figure class="container-img">
                    <img src="../img/botes/catamaranl.jpeg" alt="Catamaran Lagoon 52 FT">
                    <figcaption class="itemname">Catamaran Lagoon 52 FT</figcaption>
                </figure>
                <div class="button-group">
                    <button><i class="fa-regular fa-eye"></i></button>
                    <button><i class="fa-regular fa-heart"></i></button>
                    <button><i class="fa-solid fa-code-compare"></i></button>
                </div>
            </article>
        </a>

        <a href="../View/embarcaciones/detalle-black-panther.php" class="card-link">
            <article class="card-product">
                <figure class="container-img">
                    <img src="../img/botes/blackpanter.jpg" alt="Black Panther 41 FT">
                    <figcaption class="itemname">Black Panther 41 FT</figcaption>
                </figure>
                <div class="button-group">
                    <button><i class="fa-regular fa-eye"></i></button>
                    <button><i class="fa-regular fa-heart"></i></button>
                    <button><i class="fa-solid fa-code-compare"></i></button>
                </div>
            </article>
        </a>

    </div>
</section>
            <section class="container top-products">
                <h2 id="toures" class="heading-2">Planes y toures</h2>
                <p>Desde aventuras emocionantes hasta momentos románticos, Cartagena lo tiene todo. Explora el Volcán
                    del Totumo, navega por las Islas del Rosario, disfruta de una cena a la luz de las velas en la
                    Ciudad Amurallada o planea tu pedida de mano perfecta. Nuestros tours son completamente
                    personalizables
                </p>
                <div class="container-products">
                   
                <a href="../View/toures/detalle-sunset&night-tour.php">
                    <article class="card-product">
                        <figure class="container-img">
                            <img src="../img/toures/sunset.jpg" alt="Bahía tour">
                            <figcaption class="itemname">Sunset & Night Tour</figcaption>
                        </figure>
                        <div class="button-group">
                            <button><i class="fa-regular fa-eye"></i></button>
                            <button><i class="fa-regular fa-heart"></i></button>
                            <button><i class="fa-solid fa-code-compare"></i></button>
                        </div>
                    </article>
                    </a>

                    <a href="toures/detalle-classy-romantic.php">
                    <article class="card-product">
                        <figure class="container-img">
                            <img src="../img/toures/pedidademano.jpg" alt="Classy Romantic">
                            <figcaption class="itemname">Classy Romantic</figcaption>
                        </figure>
                        <div class="button-group">
                            <button><i class="fa-regular fa-eye"></i></button>
                            <button><i class="fa-regular fa-heart"></i></button>
                            <button><i class="fa-solid fa-code-compare"></i></button>
                        </div>
                    </article>
                   </a>

                   <a href="toures/detalle-daytour.php">
                    <article class="card-product">
                        <figure class="container-img">
                            <img src="../img/toures/daytour.jpg" alt="Day Tour">
                            <figcaption class="itemname">Day Tour</figcaption>
                        </figure>
                        <div class="button-group">
                            <button><i class="fa-regular fa-eye"></i></button>
                            <button><i class="fa-regular fa-heart"></i></button>
                            <button><i class="fa-solid fa-code-compare"></i></button>
                        </div>
                    </article>
                   </a>

                   <a href="toures/detalle-magic-dream.php">
                    <article class="card-product">
                        <figure class="container-img">
                            <img src="../img/toures/islaparadisiaca.jpg" alt="Magic Dream Island">
                            <figcaption class="itemname">Magic Dream Island</figcaption>
                        </figure>
                        <div class="button-group">
                            <button><i class="fa-regular fa-eye"></i></button>
                            <button><i class="fa-regular fa-heart"></i></button>
                            <button><i class="fa-solid fa-code-compare"></i></button>
                        </div>
                    </article>
                    </a>
                </div>
            </section>




        
    </main>


    <footer>
        <p>&copy; 2024 Classy Experiences. Todos los derechos reservados.</p>
    </footer>

    <script src="index.js"></script>
<script>
    var USER_ID = <?php echo isset($_SESSION['id']) ? (int)$_SESSION['id'] : 0; ?>;
</script>
<script>
    var USER_ID = <?php echo isset($_SESSION['id']) ? (int)$_SESSION['id'] : 0; ?>;
    if (USER_ID > 0) {
        localStorage.removeItem('carrito_usuario_0');
    }
</script>
    <script src="../JS/carrito.js"></script>
</body>

</html>