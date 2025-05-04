<?php
class Conexion {
    public static function conectar() {
        $conn = new mysqli("localhost", "root", "", "classy");
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        return $conn;
    }
}

?>
