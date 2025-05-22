<?php
require_once __DIR__ . '/../../Model/CRUD/crudUsuario.php';
$conductores = crudUsuario::getUsuariosPorTipo('conductor');
$guias = crudUsuario::getUsuariosPorTipo('guia_turistico');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Ruta</title>
</head>

<body>
    <form action="/../Classy Experiences/Controller/RutaController.php" method="post">
        <input type="hidden" name="accion" value="agregar">
        <h2>Agregar Ruta</h2>
        <p class="msg"></p>

        <input type="text" name="nombre_ruta" required placeholder="Nombre de la ruta">
        <br>
        <input type="text" name="descripcion" required placeholder="Descripción de la ruta">
        <br>
        <input type="date" name="fecha">
        <br>

        <!-- Lista de conductores -->
        <label for="conductor_id">Conductor:</label>
        <select name="conductor_id" required>
            <option value="">Seleccione un conductor</option>
            <?php foreach ($conductores as $conductor): ?>
                <option value="<?= $conductor->getId() ?>">
                    <?= htmlspecialchars($conductor->getNombre()) ?> (ID: <?= $conductor->getId() ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <br>

        <!-- Lista de guías turísticos -->
        <label for="guia_id">Guía Turístico:</label>
        <select name="guia_id" required>
            <option value="">Seleccione un guía</option>
            <?php foreach ($guias as $guia): ?>
                <option value="<?= $guia->getId() ?>">
                    <?= htmlspecialchars($guia->getNombre()) ?> (ID: <?= $guia->getId() ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <br>

        <button type="submit">Guardar Ruta</button>
        <p>Desea regresar atras?<a href="../rutas/adminRutas.php">Pagina Principal Rutas</a></p>

    </form>
</body>

</html>