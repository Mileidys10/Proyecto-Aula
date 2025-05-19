<?php
class GuiaTuristico{
private $id;
private $especialidad;
private $idiomas;
public function setId($id) { $this->id = $id; }
public function setEspecialidad($especialidad) { $this->especialidad = $especialidad; }
public function setIdiomas($idiomas) { $this->idiomas = $idiomas; }
public function getId() { return $this->id; }
public function getEspecialidad() { return $this->especialidad; }
public function getIdiomas() { return $this->idiomas; }



}

?>