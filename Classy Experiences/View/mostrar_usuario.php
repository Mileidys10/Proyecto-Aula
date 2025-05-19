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
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
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
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../Config/Conexion.php';
            require_once __DIR__ . '/../Model/Usuario.php';

            // Obtener todos los usuarios
            $result = Usuario::getAllUsuarios();

            // Verificar si hay resultados
            if ($result->num_rows > 0) {
                while ($fila = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo "<td>" . htmlspecialchars($fila['id']) . "</td>";
                    echo "<td class='editable' data-id='" . $fila['id'] . "' data-field='nombre'>" . htmlspecialchars($fila['nombre']) . "</td>";
                    echo "<td class='editable' data-id='" . $fila['id'] . "' data-field='email'>" . htmlspecialchars($fila['email']) . "</td>";
                    echo "<td class='editable' data-id='" . $fila['id'] . "' data-field='user_type'>" . htmlspecialchars($fila['user_type']) . "</td>";
                    echo "<td class='editable' data-id='" . $fila['id'] . "' data-field='password'>********</td>";
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="4">No se encontraron usuarios.</td></tr>';
            }
            ?>
        </tbody>
    </table>
    <button class="btn" id="guardarCambios">Guardar Cambios</button>
    <a href="../View/admin.php" class="btn">Volver Atrás</a>

     <script>
        // Hacer las celdas editables al hacer doble clic
        document.querySelectorAll('.editable').forEach(cell => {
            cell.addEventListener('dblclick', function () {
                const originalValue = this.textContent;
                const input = document.createElement('input');
                input.type = this.dataset.field === 'password' ? 'password' : 'text';
                input.value = this.dataset.field === 'password' ? '' : originalValue;
                input.placeholder = this.dataset.field === 'password' ? 'Nueva contraseña' : '';
                input.addEventListener('blur', function () {
    if (cell.dataset.field === 'password') {
        if (input.value.trim() !== '') {
            cell.textContent = '********';
            cell.dataset.newValue = input.value;
        } else {
            cell.textContent = originalValue;
            delete cell.dataset.newValue;
        }
    } else {
        cell.textContent = input.value || originalValue;
        cell.dataset.newValue = input.value;
    }
});
                input.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter') {
                        input.blur();
                    }
                });
                this.textContent = '';
                this.appendChild(input);
                input.focus();
            });
        });

        // Enviar los cambios al servidor al hacer clic en "Guardar Cambios"
document.getElementById('guardarCambios').addEventListener('click', function () {
    const cambios = [];
    document.querySelectorAll('.editable').forEach(cell => {
        // Solo agrega a cambios si existe data-newValue (es decir, si fue editado)
        if (cell.dataset.newValue !== undefined) {
            cambios.push({
                id: cell.dataset.id,
                field: cell.dataset.field,
                value: cell.dataset.newValue
            });
        }
    });

    if (cambios.length > 0) {
        fetch('../Controller/UsuarioController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(cambios)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Cambios guardados exitosamente.');
                location.reload();
            } else {
                alert('Error al guardar los cambios.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    } else {
        alert('No hay cambios para guardar.');
    }
});
    </script>
</body>
</html>