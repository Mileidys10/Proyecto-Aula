<?php
require_once '../Config/Conexion.php';
require_once __DIR__ . '/../Model/Usuario.php';
require_once __DIR__ . '/../Model/CRUD/crudUsuario.php';

// Obtener todos los usuarios como array de objetos
$usuarios = crudUsuario::obtenerTodos();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuarios</title>
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
    <h1>Editar Usuarios</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Tipo de Usuario</th>
                <th>Contraseña</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($usuarios) > 0): ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario->getId()) ?></td>
                        <td class='editable' data-id='<?= $usuario->getId() ?>' data-field='nombre'><?= htmlspecialchars($usuario->getNombre()) ?></td>
                        <td class='editable' data-id='<?= $usuario->getId() ?>' data-field='email'><?= htmlspecialchars($usuario->getEmail()) ?></td>
                        <td class='editable' data-id='<?= $usuario->getId() ?>' data-field='user_type'><?= htmlspecialchars($usuario->getUserType()) ?></td>
                        <td class='editable' data-id='<?= $usuario->getId() ?>' data-field='password'>********</td>
                        <td>
                        <form action="../Controller/UsuarioController.php" method="post" style="display:inline;">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id" value="<?= $usuario->getId() ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
                        <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <button class="btn" id="guardarCambios">Guardar Cambios</button>
    <a href="../admin/admin.php" class="btn">Volver Atrás</a>
    <script src="JS/usuarios.js"></script>
</body>

</html>