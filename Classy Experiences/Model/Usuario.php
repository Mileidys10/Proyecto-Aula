<?php
require_once __DIR__ . '/../Config/Conexion.php';

class Usuario {
    public static function existeEmail($email) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function registrar($nombre, $email, $password, $tipo_usuario) {
        $conn = Conexion::conectar();
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO usuarios(nombre, email, password, user_type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $email, $hashed_password, $tipo_usuario);
        return $stmt->execute();
    }

    public static function login($email) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function getUsuario($id) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function getUsuariosPorTipo($tipo = null) {
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
    return $stmt->get_result();
}


    public static function eliminarUsuario($id) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public static function actualizarUsuario($id, $nombre, $email, $password) {
        $conn = Conexion::conectar();
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("sssi", $nombre, $email, $hashed_password, $id);
        return $stmt->execute();
    }

    public static function actualizarUsuarioSinPassword($id, $nombre, $email) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nombre, $email, $id);
        return $stmt->execute();
    }

    public static function actualizarUsuarioTipo($id, $tipo) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("UPDATE usuarios SET user_type = ? WHERE id = ?");
        $stmt->bind_param("si", $tipo, $id);
        return $stmt->execute();
    }
}
?>