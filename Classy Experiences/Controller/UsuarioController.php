<?php

session_start();

require_once __DIR__ . '/../Model/Service/UsuarioService.php';
require_once __DIR__ . '/../Model/CRUD/crudUsuario.php';
require_once __DIR__ . '/../Model/CRUD/crudConductor.php';
require_once __DIR__ . '/../Model/CRUD/crudGuiaTuristico.php';
require_once __DIR__ . '/../Model/CRUD/crudAdmin.php';
require_once __DIR__ . '/../Model/Entity/Conductor.php';
require_once __DIR__ . '/../Model/Entity/GuiaTuristico.php';
require_once __DIR__ . '/../Model/Entity/Admin.php';
require_once __DIR__ . '/../Model/Entity/Usuario.php';


if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_SERVER['CONTENT_TYPE']) &&
    strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false
) {
    file_put_contents(
        __DIR__ . '/debug.log',
        print_r([
            'method'       => $_SERVER['REQUEST_METHOD'],
            'content_type' => $_SERVER['CONTENT_TYPE'] ?? '(no viene)',
            'raw'          => file_get_contents('php://input'),
        ], true),
        FILE_APPEND
    );

    header('Content-Type: application/json');
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data || !is_array($data)) {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
        exit;
    }

    $success = true;
    foreach ($data as $cambio) {
        $usuario = crudUsuario::obtenerUsuarioPorId($cambio['id']);
        if (!$usuario) {
            $success = false;
            continue;
        }
        switch ($cambio['field']) {
            case 'nombre':
                $usuario->setNombre($cambio['value']);
                break;
            case 'email':
                $usuario->setEmail($cambio['value']);
                break;
            case 'password':
                // Hashea la contraseña si lo deseas
                $usuario->setPassword(password_hash($cambio['value'], PASSWORD_DEFAULT));
                break;
            case 'user_type':
                $usuario->setUserType($cambio['value']);
                break;
        }
        if (!crudUsuario::editar($usuario)) {
            $success = false;
        }
    }
    echo json_encode(['success' => $success]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];

    if ($accion === 'registrar') {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
       if (isset($_POST['desde_admin']) && $_POST['desde_admin'] == "1") {
    $user_type = $_POST['tipo_usuario'];
} else {
    $user_type = 'user';
}

        if ($password !== $confirm_password) {
            header("Location: ../login/registro.php?msg=¡Las contraseñas no coinciden!");
            exit;
        }

        if (UsuarioService::existeEmail($email)) {
            header("Location: ../login/registro.php?msg=¡El correo ya está registrado!");
            exit;
        }

        $usuario = new Usuario();
        $usuario->setNombre($nombre);
        $usuario->setEmail($email);
        $usuario->setPassword(password_hash($password, PASSWORD_DEFAULT));
        $usuario->setUserType($user_type);

        $id_usuario = crudUsuario::agregar($usuario); // <-- debe retornar el ID insertado

        if ($id_usuario) {
            // Guardar datos extra según el tipo
            if ($user_type === 'conductor') {
                $conductor = new Conductor();
                $conductor->setId($id_usuario);
                $conductor->setLicencia($_POST['licencia'] ?? '');
                $conductor->setVehiculo($_POST['vehiculo'] ?? '');
                crudConductor::agregar($conductor);
            }
            if ($user_type === 'guia_turistico') {
                $guia = new GuiaTuristico();
                $guia->setId($id_usuario);
                $guia->setEspecialidad($_POST['especialidad'] ?? '');
                $guia->setIdiomas($_POST['idiomas'] ?? '');
                crudGuiaTuristico::agregar($guia);
            }

            if ($user_type === 'admin') {
                $admin = new Admin();
                $admin->setId($id_usuario);
                $admin->setCargo($_POST['cargo'] ?? '');
                crudAdmin::agregar($admin);
            }
            // Redirección según si es admin o no
            if (isset($_POST['desde_admin']) && $_POST['desde_admin'] == "1") {
                header("Location: ../View/admin/mostrar_usuario.php?msg=¡Usuario registrado exitosamente!");
            } else {
                header("Location: ../View/login/login.php?msg=¡Registro exitoso! Inicia sesión.");
            }
        } else {
            header("Location: ../login/registro.php?msg=¡Error al registrar el usuario!");
        }
        exit;
    }

    if ($accion === 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $usuario = crudUsuario::obtenerPorEmail($email);

        if ($usuario && password_verify($password, $usuario->getPassword())) {
            $_SESSION['id'] = $usuario->getId();
            $_SESSION['nombre'] = $usuario->getNombre();
            $_SESSION['tipo_usuario'] = $usuario->getUserType();

            if ($_SESSION['tipo_usuario'] === 'admin') {
                header("Location: ../View/admin/admin.php");
            } else {
                header("Location: ../View/index.php");
            }
        } else {
            header("Location: ../View/login/login.php?msg=¡Credenciales incorrectas!");
        }
        exit;
    }
    if ($accion === 'editar') {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user_type = $_POST['tipo_usuario'];

        $usuario = new Usuario();
        $usuario->setId($id);
        $usuario->setNombre($nombre);
        $usuario->setEmail($email);
        $usuario->setPassword(password_hash($password, PASSWORD_DEFAULT));
        $usuario->setUserType($user_type);

        crudUsuario::editar($usuario);
        header("Location: ../View/admin/mostrar_usuario.php");
        exit;
    }
    if ($accion === 'eliminar') {
        $id = $_POST['id'];

        crudUsuario::eliminarUsuario($id);
        header("Location: ../View/admin/mostrar_usuario.php");
        exit;
    }
    if ($accion === 'cerrar_sesion') {
        session_destroy();
        header("Location: ../View/index.php");
        exit;
    }
}
