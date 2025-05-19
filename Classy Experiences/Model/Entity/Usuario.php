<?php

class Usuario {
    private $id;
    private $nombre;
    private $email;
    private $password;
    private $user_type;

    // Getters y setters
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getNombre() { return $this->nombre; }
    public function setNombre($nombre) { $this->nombre = $nombre; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    public function getPassword() { return $this->password; }
    public function setPassword($password) { $this->password = $password; }

    public function getUserType() { return $this->user_type; }
    public function setUserType($user_type) { $this->user_type = $user_type; }
}






?>