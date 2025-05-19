<?php
class Ruta {
    private $id;
    private $nombre_ruta;
    private $descripcion;
    private $fecha;
    private $conductor_id;
    private $guia_id;

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getNombreRuta() { return $this->nombre_ruta; }
    public function setNombreRuta($nombre_ruta) { $this->nombre_ruta = $nombre_ruta; }

    public function getDescripcion() { return $this->descripcion; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }

    public function getFecha() { return $this->fecha; }
    public function setFecha($fecha) { $this->fecha = $fecha; }

    public function getConductorId() { return $this->conductor_id; }
    public function setConductorId($conductor_id) { $this->conductor_id = $conductor_id; }

    public function getGuiaId() { return $this->guia_id; }
    public function setGuiaId($guia_id) { $this->guia_id = $guia_id; }
}
?>