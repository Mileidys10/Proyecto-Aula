<?php
class Conductor {
    private $id;
    private $licencia;
    private $vehiculo;

    public function setId($id) { $this->id = $id; }
    public function setLicencia($licencia) { $this->licencia = $licencia; }
    public function setVehiculo($vehiculo) { $this->vehiculo = $vehiculo; }
    public function getId() { return $this->id; }
    public function getLicencia() { return $this->licencia; }
    public function getVehiculo() { return $this->vehiculo; }
}
?>