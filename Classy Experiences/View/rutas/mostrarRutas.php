<?php
require_once '../../Controller/RutaController.php';
require_once __DIR__ . '/../../Model/CRUD/crudRutas.php';
require_once __DIR__ . '/../../Model/CRUD/crudUsuario.php';

// Obtener todas las rutas
$rutas = crudRutas::obtenerTodas();

// Obtener todos los usuarios y crear un array asociativo id => nombre
$usuarios = crudUsuario::obtenerTodos();
$usuariosPorId = [];
foreach ($usuarios as $usuario) {
    $usuariosPorId[$usuario->getId()] = $usuario->getNombre();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rutas</title>
    <link rel="stylesheet" href="../Css/login.css">
    <style>
  body {
    background-color: #f9f9f9;
    color: #333;
    min-height: 100vh;
    margin-top: 80px; /* Si tu header es fijo */
    font-family: 'Arial', sans-serif;
}

h1 {
    color: #222;
    margin: 40px 0 28px 0;
    text-align: center;
    font-size: 2.2em;
    letter-spacing: 1px;
}

.table-container {
    max-width: 1200px;
    margin: 0 auto 40px auto;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.07);
    padding: 32px 18px;
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 24px;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}

th, td {
    padding: 12px 10px;
    text-align: left;
}

th {
    background: #222;
    color: #fff;
    font-weight: 600;
    font-size: 1.05em;
    border-bottom: 2px solid #c7a17a;
}

tr:nth-child(even) {
    background: #f7f7f7;
}

tr:hover {
    background: #f0e6d2;
}

.editable {
    background: #f9f9f9;
    cursor: pointer;
    transition: background 0.2s;
}

.editable:hover {
    background: #f1e0c6;
}

.btn,
button.btn {
    padding: 10px 22px;
    background: #111;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    font-size: 1em;
    cursor: pointer;
    margin-top: 10px;
    transition: background 0.2s;
    display: inline-block;
}

.btn-danger {
    background: #e74c3c !important;
    color: #fff !important;
}

.btn-danger:hover {
    background: #c0392b !important;
}

.btn:hover {
    background: #ff6347;
}

a.btn, a.button, .btn-link {
    padding: 10px 22px;
    background: #111;
    color: #fff !important;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    font-size: 1em;
    cursor: pointer;
    margin-top: 10px;
    text-decoration: none;
    transition: background 0.2s;
    display: inline-block;
}

a.btn:hover, a.button:hover, .btn-link:hover {
    background: #ff6347;
    color: #fff !important;
}

@media (max-width: 900px) {
    .table-container {
        padding: 10px 2vw;
    }
    table, th, td {
        font-size: 0.95em;
    }
    h1 {
        font-size: 1.3em;
    }
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
                <th>Guía Turístico</th>
                <th>Conductor</th>
                <th>Eliminar</th>
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
                <td>
                    <?= isset($usuariosPorId[$ruta->getGuiaId()]) ? htmlspecialchars($usuariosPorId[$ruta->getGuiaId()]) . " (ID: " . $ruta->getGuiaId() . ")" : 'Sin asignar' ?>
                </td>
                <td>
                    <?= isset($usuariosPorId[$ruta->getConductorId()]) ? htmlspecialchars($usuariosPorId[$ruta->getConductorId()]) ." (ID " .$ruta->getConductorId() . ")": 'Sin asignar' ?>
                </td>
                <td>
                    <form action="../../Controller/RutaController.php" method="post" style="display:inline;">
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
<a href="../rutas/adminRutas.php" class="btn">Página Principal Rutas</a>
    <script src="JS/rutas.js"></script>
</body>

</html>
