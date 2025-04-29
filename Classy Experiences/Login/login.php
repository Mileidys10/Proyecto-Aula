<?php
session_start(); // <<< Esto debe ser lo primero de todo
include("conexion.php");

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
            header('location:user.php');
            exit();
        } elseif ($row1['user_type'] == 'admin') {
            $_SESSION['admin'] = $row1['email'];
            $_SESSION['id'] = $row1['id'];
            header('location:admin.php');
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
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form">
        <form action="" method="post">
            <h2>login</h2>
            <p class="mssg"><?php echo $msg; ?></p>
            <div class="form-group">
                <input type="email" name="email"  class="form-control" required placeholder="Ingresa tu correo" >
            </div>
            <div class="form-group">
                <input type="password" name="password"  class="form-control" required placeholder="Ingresa tu contraseña" >
            </div>
            <button class="btn font-weight-bold" name="submit">Iniciar sesión ahora</button>
            <p>No tienes una cuenta? <a href="registro.php">Registrate ahora</a></p>
        </form>
    </div>
</body>
</html>
