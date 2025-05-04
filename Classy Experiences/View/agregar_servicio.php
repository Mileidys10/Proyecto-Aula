<?php
require_once '../Controller/AdminController.php';

$msg = $_GET['msg'] ?? '';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$usuarioActivo = isset($_SESSION['id']); // Verifica si hay un usuario activo

?>








<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Servicio</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="agregar_servicios.css">
</head>
<body>

    <!-- Barra lateral y contenido -->
    <div class="dashboard-container">

        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Panel Admin</h2>
            <ul>
                <li><a href="admin.php">Inicio</a></li>
                <li><a href="agregar_servicio.php" class="active">Agregar Servicio</a></li>
                <li><a href="../Controller/LogoutController.php">Cerrar sesión</a></li>
            </ul>
        </aside>

        <!-- Main content -->
        <main class="main-content">
            <section class="agregar-servicio-section">
                <h1>Agregar nuevo servicio</h1>

                <?php if ($mensaje): ?>
                    <div class="mensaje">
                        <?= $mensaje ?>
                    </div>
                <?php endif; ?>

                <form action="agregar_servicio.php" method="POST" enctype="multipart/form-data" class="agregar-servicio-form">
                    <label for="nombre">Nombre del servicio:</label>
                    <input type="text" name="nombre" required>

                    <label for="descripcion">Descripción:</label>
                    <textarea name="descripcion" rows="4" required></textarea>

                    <label for="precio">Precio (COP):</label>
                    <input type="number" name="precio" step="0.01" required>

                    <label for="categoria">Categoría:</label>
                    <select name="categoria" required>
                        <option value="hospedaje">Hospedaje</option>
                        <option value="tour">Tour</option>
                        <option value="transporte">Transporte</option>
                        <option value="otros">Otros</option>
                    </select>

                    <label for="imagen">Imagen destacada:</label>
                    <input type="file" name="imagen" accept="image/*" required>

                    <button type="submit" name="guardar">Guardar servicio</button>
                </form>
            </section>
        </main>
    </div>

</body>
</html>
