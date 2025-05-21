<?php
require_once __DIR__ . '/../Entity/GuiaTuristico.php';
require_once __DIR__ . '/../../Config/Conexion.php';

class crudGuiaTuristico{
    public static function agregar(GuiaTuristico $guia){
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("INSERT INTO guia_turistico (id, especialidad, idiomas) VALUES (?, ?, ?)");
        $stmt->bind_param(
            "iss",
            $guia->getId(),
            $guia->getEspecialidad(),
            $guia->getIdiomas()
        );
        return $stmt->execute();
    }
}

?>