
<?php
// Verifica si la sesión está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario está autenticado y es administrador
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    // Redirige al login si no está autenticado
    header("Location: login.php?msg=¡Debes iniciar sesión como administrador!");
    exit;
}

// Asignar el nombre del admin a una variable para mostrarlo
$admin_nombre = $_SESSION['nombre']; 
$usuarioActivo = true; // Esto habilita el botón de cerrar sesión
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../../Css/adminrutas.css"> 
    <link rel="stylesheet" href="../../css/dashboard.css">
    
</head>

<body>

    <!-- Header -->
    <header>
        <div class="logo">
            <img src="../../img/classy.png" alt="Logo"> 
            <span>Panel de Administración</span>
        </div>
        <nav>
            <a href="../admin/admin.php">Inicio</a>
            <a href="../admin/registro_usuarios_admin.php">Registrar Usuario</a>
            <a href="../admin/mostrar_usuario.php">mostrar usuarios</a>



        </nav>
    </header>

    <!-- Hero Section -->
    <section id="hero">
        <h1>Bienvenido, <?php echo htmlspecialchars($admin_nombre); ?></h1>
        <p>Desde este panel serás redirigido a diferentes opciones de gestión de rutas.</p>
    </section>


    <!-- Servicios -->
    <section id="servicios">
        <div class="container servicios">
            <div class="cartas">
                <a href="../rutas/agregarRuta.php">
                    <h3>Agregar Ruta</h3>
                    <p>Crea una nueva ruta.</p>
                </a>
            </div>
            <div class="cartas">
                <a href="../rutas/mostrarRutas.php">
                    <h3>Mostrar Rutas</h3>
                    <p>Visualiza un listado de todas las rutas actuales.</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <img src="../../img/classy.png" alt="creado por rafaxd" style="width:40px;">
        </div>
    </footer>

</body>

</html>
