<?php
require_once '../Config/Conexion.php';
require_once __DIR__ . '/../Model/Rutas.php';
require_once __DIR__ . '/../Model/CRUD/crudRutas.php';

// Obtener todos los usuarios como array de objetos
$rutas = crudRutas::obtenerTodas();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rutas</title>
    <link rel="stylesheet" href="../Css/login.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .editable {
            background-color: #f9f9f9;
            cursor: pointer;
        }

        .btn {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1> Rutas</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Ruta</th>
                <th>Descripcion</th>
                <th>Fecha</th>
                <th>ID Guia Turistico</th>
                <th>ID Conductor</th>
            </tr>
        </thead>
       <tbody>
    <?php if (count($rutas) > 0): ?>
        <?php foreach ($rutas as $ruta): ?>
            <tr>
                <td><?= htmlspecialchars($ruta->getId()) ?></td>
                <td class='editable' data-id='<?= $ruta->getId() ?>' data-field='nombre_ruta'><?= htmlspecialchars($ruta->getNombreRuta()) ?></td>
                <td class='editable' data-id='<?= $ruta->getId() ?>' data-field='descripcion'><?= htmlspecialchars($ruta->getDescripcion()) ?></td>
                <td class='editable' data-id='<?= $ruta->getId() ?>' data-field='fecha'><?= htmlspecialchars($ruta->getFecha()) ?></td>
                <td class='editable' data-id='<?= $ruta->getId() ?>' data-field='guia_id'><?= htmlspecialchars($ruta->getGuiaId()) ?></td>
                <td class='editable' data-id='<?= $ruta->getId() ?>' data-field='conductor_id'><?= htmlspecialchars($ruta->getConductorId()) ?></td>
             <td>
                <form action="../Controller/RutaController.php" method="post" style="display:inline;">
                    <input type="hidden" name="accion" value="eliminar">
                    <input type="hidden" name="id" value="<?= $ruta->getId() ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta ruta?');">Eliminar</button>
                </form>
            </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7">No se encontraron rutas.</td>
        </tr>
    <?php endif; ?>
</tbody>
    </table>
    <button class="btn" id="guardarCambios">Guardar Cambios</button>
    <a href="../rutas/adminRutas.php">Pagina Principal Rutas</a>
    <script src="JS/rutas.js"></script>
</body>

</html>
