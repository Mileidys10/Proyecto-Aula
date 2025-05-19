<?php
class Admin{
private $id;
private $cargo;

public function setId($id) {
    $this->id = $id;

}
public function setCargo($cargo) {
    $this->cargo = $cargo;
}
public function getId() {
    return $this->id;
}
public function getCargo() {
    return $this->cargo;
}
}
?>