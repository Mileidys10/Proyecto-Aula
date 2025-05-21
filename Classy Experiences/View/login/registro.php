<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../../Css/login.css">
</head>

<body>
    <div class="form">
        <form action="../../Controller/UsuarioController.php" method="post">
            <input type="hidden" name="accion" value="registrar">

            <h2>Registro</h2>
            <p class="msg"></p>
            <div class="form-group">
                <input type="text" name="nombre" required placeholder="Ingresa tu nombre" class="form-control">
            </div>
            <div class="form-group">
                <input type="email" name="email" required placeholder="Ingresa tu correo" class="form-control">
            </div>
           
            <div class="form-group">
                <input type="password" name="password" required placeholder="Ingresa tu contraseña" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" required placeholder="Confirmar tu contraseña" class="form-control">
            </div>
            <button class="btn font-weight-bold" name="submit">Registrate ahora</button>
            <p>Ya tienes una cuenta? <a href="../login/login.php">Inicia sesión ahora</a></p>
        </form>
    </div>
</body>

</html>