<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../Css/login.css">
</head>
<body>
    <div class="form">
        <form action="../Controller/UsuarioController.php" method="post">
    <input type="hidden" name="accion" value="registrar">
    <input type="hidden" name="desde_admin" value="1">
    <h2>Registro</h2>
    <div class="form-group">
        <input type="text" name="nombre" required placeholder="Ingresa el nombre" class="form-control">
    </div>
    <div class="form-group">
        <input type="email" name="email" required placeholder="Ingresa el correo" class="form-control">
    </div>
    <div class="form-group">
        <input type="password" name="password" required placeholder="Ingresa la contraseña" class="form-control">
    </div>
    <div class="form-group">
        <input type="password" name="confirm_password" required placeholder="Confirmar la contraseña" class="form-control">
    </div>
    <div class="form-group">
        <select name="tipo_usuario" id="tipo_usuario" class="form-control" required>
            <option value="user">Usuario</option>
            <option value="admin">Administrador</option>
            <option value="conductor">Conductor</option>
            <option value="guia_turistico">Guía Turístico</option>
        </select>
    </div>
    <!-- Campos adicionales, puedes mostrarlos/ocultarlos con JS según el tipo seleccionado -->
    <div class="form-group" id="conductor_fields" style="display:none;">
        <input type="text" name="licencia" placeholder="Licencia">
        <input type="text" name="vehiculo" placeholder="Vehículo">
    </div>
    <div class="form-group" id="guia_fields" style="display:none;">
        <input type="text" name="especialidad" placeholder="Especialidad">
        <input type="text" name="idiomas" placeholder="Idiomas">
    </div>
    <div class="form-group" id="admin_fields" style="display:none;">
        <input type="text" name="cargo" placeholder="Cargo">
    </div>
    <button class="btn font-weight-bold" name="submit">Registrate ahora</button>
    <p>Desea regresar atras?<a href="../admin/admin.php">Pagina Principal Admin</a></p>
</form>
    </div>
    <button class="btn" id="guardarCambios">Guardar Cambios</button>
    <a href="../admin/admin.php" class="btn">Volver Atrás</a>
    <script src="../JS/registro.js"></script>
</body>
</html>