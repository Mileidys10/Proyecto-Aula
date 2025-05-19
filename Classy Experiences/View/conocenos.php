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
    <title>Conócenos - Classy Experiences</title>
    <link rel="stylesheet" href="../Css/conocenos.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" crossorigin="anonymous"></script>

</head>
<body>
    <!-- Encabezado -->
    <header>
        <a class="logo" href="../View/index.php">
            <img src="../img/classy.png" alt="logo">
            <h2 class="nombredelaempresa">Classy</h2>
        </a>

        <nav>
          <a href="../view/atencionCliente/contacto.php">Atencion al cliente</a>
            <a href="../View/index.php">Home</a>
            <a href="../View/servicios.php">Servicios</a>
            <a href="../View/conocenos.php">Conócenos</a>
            <a href="../View/redes.php">Redes Sociales</a>
            <a href="../View/reseñas/resenas.php">Reseñas</a>
            <a href="../View/login/login.php">Iniciar Sesion</a>
            <a href="../login/login.php">Iniciar Sesion</a>
            <?php if ($usuarioActivo): ?>
            <a href="../Controller/LogoutController.php">Cerrar sesión</a>
            
        <?php endif; ?>        </nav>
        <a href="../View/carrito.php" class="carrito">
                <i class="fas fa-shopping-cart"></i>
                <span class="contador" id="contador-carrito">0</span> 
            </a>
    </header>

    
    <section id="quienes-somos">
        <h3>¿Quiénes Somos?</h3>
        <p><strong>Classy Experiences</strong> es una empresa que ofrece <strong>experiencias turísticas de lujo en Cartagena</strong>, mezclando exclusividad, comodidad y autenticidad. Nos enfocamos en resaltar la riqueza cultural, histórica y natural de Cartagena con servicios de primera clase.</p>
        <p>Estamos capacitados en el mercado de chárter náutico y turístico, <strong>identificando las necesidades de los clientes y oportunidades</strong> en los diferentes escenarios de la ciudad de Cartagena.</p>
    </section>

    
    <section id="lo-que-nos-destaca">
        <h1>Lo que nos destaca</h1>
        <article>
            <h2>Experiencias Exclusivas</h2>
            <p>Ofrecemos experiencias turísticas diseñadas para los gustos más exigentes, desde recorridos privados por Cartagena hasta escapadas de lujo en islas cercanas.</p>
        </article>
        <article>
            <h2>Atención Personalizada</h2>
            <p>Personalizamos cada viaje según las necesidades de nuestros clientes, asegurando un servicio excepcional y momentos memorables.</p>
        </article>
        <article>
            <h2>Conexiones Locales</h2>
            <p>Contamos con <strong>sólidas relaciones con proveedores locales</strong>, permitiendo acceso exclusivo a lugares y actividades únicas.</p>
        </article>
        <article>
            <h2>Compromiso con la Calidad</h2>
            <p>Mantenemos altos estándares de calidad en nuestros servicios, superando las expectativas de quienes buscan <strong>experiencias de lujo en Cartagena</strong>.</p>
        </article>
    </section>

    


    <!-- Sección: Contacto -->
    <footer id="contacto">
        <h2>Contáctanos</h2>
        <p>Directoras:</p>
        <ul>
            <li>Laura Vargas - Directora de Operaciones</li>
            <li>Raisha Pérez - Directora Comercial</li>
        </ul>
        <p>Teléfonos: +57 3101499-0789 / +6713001215-5938</p>
        <p>Email: classyexperiences@gmail.com</p>
        <p>Redes Sociales: @aclassyexperiences</p>
    </footer>
</body>
</html>
