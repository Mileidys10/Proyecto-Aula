<?php
require_once __DIR__ . '/../../Model/CRUD/crudUsuario.php';
require_once __DIR__ . '/../../Model/Entity/Usuario.php';

// Obtener todos los usuarios como array de objetos
if (isset($_GET['tipo']) && $_GET['tipo'] !== '') {
    $usuarios = array_filter(
        crudUsuario::obtenerTodos(),
        function ($usuario) {
            return $usuario->getUserType() === $_GET['tipo'];
        }
    );
} else {
    $usuarios = crudUsuario::obtenerTodos();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuarios</title>
    <link rel="stylesheet" href="../../Css/adminrutas.css">
    <link rel="stylesheet" href="../../Css/mostrar_usuario.css">
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

<header>
    <div class="logo">
        <img src="../../img/classy.png" alt="Logo">
        <span>Panel de Administración</span>
    </div>
    <nav>
        <a href="admin.php">Inicio</a>
        <a href="../admin/registro_usuarios_admin.php">Registrar Usuario</a>

        <a href="../../View/rutas/adminRutas.php">Rutas</a>


    </nav>
</header>

<body>

    <main class="main-dashboard">


        <h1>Editar Usuarios</h1>
        <form method="GET" style="margin-bottom: 15px;">
            <label for="tipo">Filtrar por tipo de usuario:</label>
            <select name="tipo" id="tipo">
                <option value="">-- Todos --</option>
                <option value="admin" <?= (isset($_GET['tipo']) && $_GET['tipo'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                <option value="user" <?= (isset($_GET['tipo']) && $_GET['tipo'] == 'user') ? 'selected' : '' ?>>User</option>
                <option value="conductor" <?= (isset($_GET['tipo']) && $_GET['tipo'] == 'conductor') ? 'selected' : '' ?>>Conductor</option>
                <option value="guia_turistico" <?= (isset($_GET['tipo']) && $_GET['tipo'] == 'guia_turistico') ? 'selected' : '' ?>>Guía Turístico</option>
            </select>
            <button type="submit" class="btn">Mostrar</button>
        </form>
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
                                <form action="../../Controller/UsuarioController.php" method="post" style="display:inline;">
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
        <br><br> <a href="../admin/admin.php" class="btn">Volver Atrás</a>
        <script src="../../JS/usuarios.js"></script>
    </main>
</body>

</html>