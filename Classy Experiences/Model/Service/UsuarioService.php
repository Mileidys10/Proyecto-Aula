<?php
require_once __DIR__ . '/../Usuario.php';
require_once __DIR__ . '/../../Config/Conexion.php';

class UsuarioService{
  

    public static function existeEmail($email) {
    $conn = Conexion::conectar();
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

   


  
}

?>