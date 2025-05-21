<?php
require_once __DIR__ . '/../../Config/Conexion.php';
class Reseña
{
    private $id;
    private $nombre;
    private $comentario;
    private $puntuacion;
    private $fecha;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getComentario()
    {
        return $this->comentario;
    }

    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }
    public function getPuntuacion()
    {
        return $this->puntuacion;
    }
    public function setPuntuacion($puntuacion)
    {
        $this->puntuacion = $puntuacion;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
}
