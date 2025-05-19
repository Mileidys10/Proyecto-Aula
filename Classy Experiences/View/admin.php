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
    <link rel="stylesheet" href="../Css/dashboard.css"> 
    
</head>

<body>

    <!-- Header -->
    <header>
        <div class="logo">
            <img src="../Media/classy.png" alt="Logo"> 
            <span>Panel de Administración</span>
        </div>
        <nav>
            <a href="admin.php">Inicio</a>
            <a href="agregar_servicio.php">Agregar Servicio</a>
            <a href="estadisticas.php">Estadísticas</a>
            <a href="reservas.php">Reservas</a>
            <a href="registro_usuarios_admin.php">Registro Usuarios</a>
            <a href="mostrar_usuario.php">mostrar usuarios</a>
            <?php if ($usuarioActivo): ?>
    <a href="../Controller/LogoutController.php">Cerrar sesión</a>
<?php endif; ?>

        </nav>
    </header>

    <!-- Hero Section -->
    <section id="hero">
        <h1>Bienvenido, <?php echo htmlspecialchars($admin_nombre); ?></h1>
        <p>Desde aquí puedes gestionar servicios turísticos, revisar estadísticas y más.</p>
    </section>

    <!-- Resumen General -->
    <section id="whoareus">
        <div class="container">
            <h2>Resumen General</h2>
            <div class="summary-card">
                <p>Total de servicios publicados: <strong>12</strong></p>
            </div>
            <div class="summary-card">
                <p>Reservas este mes: <strong>38</strong></p>
            </div>
            <div class="summary-card">
                <p>Ingresos aproximados: <strong>$4,200,000 COP</strong></p>
            </div>
        </div>
    </section>

    <!-- Servicios -->
    <section id="servicios">
        <div class="container servicios">
            <div class="cartas">
                <a href="agregar_servicio.php">
                    <h3>Agregar Servicio</h3>
                    <p>Crea un nuevo tour, bote o actividad.</p>
                </a>
            </div>
            <div class="cartas">
                <a href="estadisticas.php">
                    <h3>Ver Estadísticas</h3>
                    <p>Visualiza el rendimiento de tus servicios.</p>
                </a>
            </div>
            <div class="cartas">
                <a href="reservas.php">
                    <h3>Ver Reservas</h3>
                    <p>Gestiona las reservas recientes.</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <img src="../Media/classy.png" alt="Pie de página">
        </div>
    </footer>

</body>

</html>
