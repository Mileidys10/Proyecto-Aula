<?php
session_start();

// Verifica si hay sesión activa
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login/login.php');
    exit();
}

// Si todo está bien, recupera el nombre
$admin_nombre = $_SESSION['admin_nombre']; 
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="dashboard.css"> 
</head>

<body>

    <!-- Header -->
    <header>
        <div class="logo">
            <img src="../img/classy.png" alt="Logo"> 
            <span>Panel de Administración</span>
        </div>
        <nav>
            <a href="admin.php">Inicio</a>
            <a href="agregar_servicio.php">Agregar Servicio</a>
            <a href="estadisticas.php">Estadísticas</a>
            <a href="reservas.php">Reservas</a>
            <a href="logout.php">Cerrar Sesión</a>
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
            <img src="../img/classy.png" alt="Pie de página">
        </div>
    </footer>

</body>

</html>
