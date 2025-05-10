<?php
session_start();
require_once __DIR__ . '/../Model/Usuario.php';
require_once '../Config/Conexion.php';
$msg = "";

if (isset($_POST['submit']) && isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion === 'registrar') {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $tipo_usuario = $_POST['tipo_usuario'];
    
        if ($password !== $confirm_password) {
            header("Location: ../View/registro.php?msg=¡Las contraseñas no coinciden!");
            exit;
        }
    
        if (Usuario::existeEmail($email)->num_rows > 0) {
            header("Location: ../View/registro.php?msg=¡El correo ya está registrado!");
            exit;
        }
    
        if (Usuario::registrar($nombre, $email, $password, $tipo_usuario)) {
            header("Location: ../View/login.php?msg=¡Registro exitoso! Inicia sesión.");
        } else {
            header("Location: ../View/registro.php?msg=¡Error al registrar el usuario!");
        }
        exit;
    } elseif ($accion === 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $usuario = Usuario::login($email);
        if ($usuario->num_rows > 0) {
            $row = $usuario->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // GUARDAMOS DATOS EN SESIÓN
                $_SESSION['id'] = $row['id'];
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['tipo_usuario'] = $row['user_type'];
        
                if ($row['user_type'] === 'admin') {
                    header("Location: ../View/admin.php");
                } else {
                    header("Location: ../View/index.php");
                }
                exit;
            } else {
                // Contraseña incorrecta
                header("Location: ../View/login.php?msg=¡Contraseña incorrecta!");
                exit;
            }
        } else {
            // Usuario no encontrado
            header("Location: ../View/login.php?msg=¡Correo no registrado!");
            exit;
        }
}
}

?>