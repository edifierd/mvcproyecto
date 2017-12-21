<?php

class DatoDemografico {

    private $id;
    private $heladera;
    private $electricidad;
    private $mascota;
    private $vivienda;
    private $agua;
    private $calefaccion;
    private $paciente_id;


    public function __construct($id, $electricidad, $heladera, $mascota, $tipo_vivienda_id,  $tipo_agua_id, $tipo_calefaccion_id,$paciente_id) {
        $this->id = $id;
        $this->heladera = $heladera;
        $this->electricidad = $electricidad;
        $this->mascota = $mascota;
        $this->vivienda = $tipo_vivienda_id;
        $this->agua = $tipo_agua_id;
        $this->calefaccion = $tipo_calefaccion_id;
        $this->paciente_id = $paciente_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getHeladera() {
        return ($this->heladera) ? "Si" : "No";
    }

    public function getElectricidad() {
        return ($this->electricidad) ? "Si" : "No";
    }

    public function getMascota() {
        return ($this->mascota) ? "Si" : "No";
    }

    public function getPacienteId() {
        return $this->paciente_id;
    }

    public function getVivienda()
    {
      return ViviendaRepository::getInstance()->getById($this->vivienda);
    }

    public function getAgua()
    {
      return AguaRepository::getInstance()->getById($this->agua);
    }

    public function getCalefaccion()
    {
      return CalefaccionRepository::getInstance()->getById($this->calefaccion);
    }


}
