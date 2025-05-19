<?php
require_once __DIR__ . '/../../Config/Conexion.php';
require_once __DIR__ . '/../Usuario.php';

class crudUsuario
{
    public static function agregar(Usuario $usuario)
    {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password, user_type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param(
            "ssss",
            $usuario->getNombre(),
            $usuario->getEmail(),
            $usuario->getPassword(),
            $usuario->getUserType()
        );
        return $stmt->execute();
    }

    
    

    public static function editar(Usuario $usuario)
    {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("UPDATE usuarios SET nombre=?, email=?, password=?, user_type=? WHERE id=?");
        $stmt->bind_param(
            "ssssi",
            $usuario->getNombre(),
            $usuario->getEmail(),
            $usuario->getPassword(),
            $usuario->getUserType(),
            $usuario->getId()
        );
        return $stmt->execute();
    }

    public static function eliminarUsuario($id)
    {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("DELETE FROM usuarios WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public static function obtenerUsuarioPorId($id)
    {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $fila = $result->fetch_assoc();
        if (!$fila) {
            return null;
        }
        return self::cargar_usuario($fila);
    }
    public static function obtenerNombrePorId($id)
    {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("SELECT nombre FROM usuarios WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($nombre);
        $stmt->fetch();
        $stmt->close();
        return $nombre ?: 'No asignado';
    }
    public static function obtenerPorEmail($email)
    {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $usuario = new Usuario();
            $usuario->setId($row['id']);
            $usuario->setNombre($row['nombre']);
            $usuario->setEmail($row['email']);
            $usuario->setPassword($row['password']);
            $usuario->setUserType($row['user_type']);
            return $usuario;
        }
        return null;
    }

    public static function getUsuariosPorTipo($tipo = null)
    {
        $conn = Conexion::conectar();

        if ($tipo === 'admin' || $tipo === 'user') {
            $stmt = $conn->prepare("SELECT * FROM usuarios WHERE user_type = ?");
            $stmt->bind_param("s", $tipo);
        } elseif ($tipo === 'conductor') {
            $stmt = $conn->prepare("
            SELECT u.* FROM usuarios u
            INNER JOIN conductor c ON u.id = c.id
        ");
        } elseif ($tipo === 'guia_turistico') {
            $stmt = $conn->prepare("
            SELECT u.* FROM usuarios u
            INNER JOIN guia_turistico g ON u.id = g.id
        ");
        } else {
            $stmt = $conn->prepare("SELECT * FROM usuarios");
        }

        $stmt->execute();
 $result = $stmt->get_result();
    $usuarios = [];
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = self::cargar_usuario($row);
    }
    return $usuarios;

        
    }
    public static function cargar_usuario($row)
    {
        $usuario = new Usuario();
        $usuario->setId($row['id']);
        $usuario->setNombre($row['nombre']);
        $usuario->setEmail($row['email']);
        $usuario->setPassword($row['password']);
        $usuario->setUserType($row['user_type']);
        return $usuario;
    }

public static function obtenerTodos()
    {
        $conn = Conexion::conectar();
        $result = $conn->query("SELECT * FROM usuarios");
        $usuarios = [];
        while ($row = $result->fetch_assoc()) {
            $usuario = new Usuario();
            $usuario->setId($row['id']);
            $usuario->setNombre($row['nombre']);
            $usuario->setEmail($row['email']);
            $usuario->setPassword($row['password']);
            $usuario->setUserType($row['user_type']);
            $usuarios[] = $usuario;
        }
        return $usuarios;
    }



}
