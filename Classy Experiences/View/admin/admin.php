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



require_once '../../Model/CRUD/crudEstadisticas.php';

$mesActual = date('n'); // sin cero inicial
$anioActual = date('Y');

$reservasMes = crudEstadisticas::reservasMes($mesActual, $anioActual);
$ingresosMes = crudEstadisticas::ingresosMes($mesActual, $anioActual);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../../Css/dashboard.css"> 
    
</head>

<body>

    <!-- Header -->
    <header>
        <div class="logo">
            <img src="../../img/classy.png" alt="Logo"> 
            <span>Panel de Administración</span>
            
        </div>
        <nav>
            <a href="../index.php">Sitio Web Classy</a>
            <a href="admin.php">Inicio</a>
            <a href="../admin/registro_usuarios_admin.php">Registrar Usuario</a>
            <a href="../admin/mostrar_usuario.php">mostrar usuarios</a>
            <a href="../../View/rutas/adminRutas.php">Rutas</a>
            <?php if ($usuarioActivo): ?>
          <a href="../../Controller/LogoutController.php">Cerrar sesión</a>
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
            <p>Reservas este mes: <strong><?= $reservasMes ?></strong></p>
        </div>
        <div class="summary-card">
            <p>Ingresos aproximados: <strong>$<?= number_format($ingresosMes, 0, ',', '.') ?></strong> cop</p>
        </div>
    </div>
</section>

    <!-- Servicios -->
    <section id="servicios">
        <div class="container servicios">

            <div class="cartas">
                <a href="estadisticas.php">
                    <h3>Ver Estadísticas</h3>
                    <p>Visualiza el rendimiento de tus servicios.</p>
                </a>
            </div>
            <div class="cartas">
                <a href="mostrarfacturas.php">
                    <h3>Ver Facturas</h3>
                    <p>Revisa las facturas.</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <img src="../../img/classy.png" alt="Creado por Rafa">
        </div>
    </footer>

</body>

</html>
