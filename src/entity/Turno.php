<?php

class Turno {

    public $id;
    public $fecha;
    public $horario_id;
    public $dni;

    public function __construct($id,$fecha,$horario_id,$dni) {
      $this->id = $id;
      $this->fecha = $fecha;
      $this->horario_id = $horario_id;
      $this->dni = $dni;
    }

    public function getId(){
      return $this->id;
    }

    public function getFecha(){
      return $this->fecha;
    }

    public function getHorario(){
      return HorarioRepositori::getInstance()->getHorario($this->horario_id);
    }

    public function getDni(){
      return $this->dni;
    }


}
