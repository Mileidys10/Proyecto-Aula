<?php
include("conexion.php");
$msg = '';

if (isset($_POST['submit'])) {
    $name = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirm_password'];
    $user_type = $_POST['tipo_usuario'];

    // Validar si el usuario ya existe
    $select = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $msg = "¡El usuario ya existe!";
    } elseif ($password !== $cpassword) {
        $msg = "Las contraseñas no coinciden.";
    } else {
        // Encriptar la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insertar usuario
        $insert = "INSERT INTO usuarios(nombre, email, password, user_type)
                   VALUES ('$name', '$email', '$hashed_password', '$user_type')";

        if (mysqli_query($conn, $insert)) {
            header("Location: login.php");
            exit;
        } else {
            $msg = "Error al registrar el usuario.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form">
        <form action="" method="post">
            <h2>Registro</h2>
            <p class="mssg"></p>
            <div class="form-group">
                <input type="text" name="nombre"  required placeholder="Ingresa tu nombre" class="form-control" >
            </div>
            <div class="form-group">
                <input type="email" name="email"  required placeholder="Ingresa tu correo" class="form-control" >
            </div>
            <div class="form-group">
                <select name="tipo_usuario" id="" class="form-control">
                    <option value="user">Usuario</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>
            <div class="form-group">
                <input type="password" name="password"  required placeholder="Ingresa tu contraseña" class="form-control" >
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" required placeholder="Confirmar tu contraseña" class="form-control" >
            </div>
            <button class="btn font-weight-bold" name="submit">Registrate ahora</button>
            <p>Ya tienes una cuenta? <a href="login.php">Inicia sesión ahora</a></p>
        </form>
    </div>
</body>
</html>