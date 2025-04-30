<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conexion.php");
if (!$conn) {
    die("No se pudo conectar a la base de datos: " . mysqli_connect_error());
}

$msg = '';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $select1 = "SELECT * FROM usuarios WHERE email = '$email'";
    $select_user = mysqli_query($conn, $select1);

    if (mysqli_num_rows($select_user) > 0) {
        $row1 = mysqli_fetch_assoc($select_user);

        if ($row1['user_type'] == 'user') {
            $_SESSION['user'] = $row1['email'];
            $_SESSION['id'] = $row1['id'];
            header('Location: user.php');
            exit();
        } elseif ($row1['user_type'] == 'admin') {
            $_SESSION['admin'] = $row1['email'];
            $_SESSION['admin_nombre'] = $row1['nombre'];
            $_SESSION['admin_id'] = $row1['id']; 
            $_SESSION['id'] = $row1['id'];
            header('Location: ../admin/admin.php');
            exit();
        }
    } else {
        $msg = "¡Correo o contraseña incorrectos!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="form">
        <form action="" method="post">
            <h2>Login Classy </h2>
            <p class="mssg"><?php echo $msg; ?></p>
            <div class="form-group">
                <input type="email" name="email"  class="form-control" required placeholder="Ingresa tu correo" >
            </div>
            <div class="form-group">
                <input type="password" name="password"  class="form-control" required placeholder="Ingresa tu contraseña" >
            </div>
            <button class="btn font-weight-bold" name="submit">Iniciar sesión ahora</button>
            <br><br>
            <p>No tienes una cuenta? <a href="registro.php">Registrate ahora</a></p>
        </form>
    </div>
</body>
</html>
