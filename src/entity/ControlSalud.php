<?php

class ControlSalud {

  public $id;
  public $edadSemanas;
  public $fecha;
  public $peso;
  public $vacunas_completas;
  public $maduracion_acorde;
  public $ex_fisico_normal;
  public $ex_fisico_observaciones;
  public $pc;
  public $ppc;
  public $talla;
  public $alimentacion;
  public $observaciones_generales;
  public $paciente_id;
  public $usuario_id;


  public function __construct($id,$fecha,$peso,$vacunas_completas,$maduracion_acorde,$maduracion_observaciones,$ex_fisico_normal,$ex_fisico_observaciones,$pc,$ppc,$talla,$alimentacion,$observaciones_generales,$paciente_id,$usuario_id) {
    $this->id = $id;
    $this->fecha = $fecha;
    $this->peso = (double) $peso;
    $this->vacunas_completas = $vacunas_completas;
    $this->maduracion_acorde = $maduracion_acorde;
    $this->maduracion_observaciones = $maduracion_observaciones;
    $this->ex_fisico_normal = $ex_fisico_normal;
    $this->ex_fisico_observaciones = $ex_fisico_observaciones;
    $this->pc = $pc;
    $this->ppc = (int) $ppc;
    $this->talla = (int) $talla;
    $this->alimentacion = $alimentacion;
    $this->observaciones_generales = $observaciones_generales;
    $this->paciente_id = $paciente_id;
    $this->usuario_id = $usuario_id;
    $this->edadSemanas = $this->getEdadSemanas($this->fecha);
  }

  public function getId() {
    return $this->id;
  }


  public function getFecha() {
    return $this->fecha;
  }

  public function getPeso() {
    return $this->peso;
  }

  public function getVacunasCompletas() {
    return ($this->vacunas_completas) ? "Si" : "No";
  }

  public function getMaduracionAcorde() {
    return ($this->maduracion_acorde) ? "Si" : "No";
  }

  public function getMaduracionObservaciones()
  {
    return ($this->maduracion_observaciones);
  }

  public function getExFisicoNormal() {
    return ($this->ex_fisico_normal) ? "Si" : "No";
  }

  public function getExFisicoObservaciones() {
    return $this->ex_fisico_observaciones;
  }

  public function getPc() {
    return $this->pc;
  }

  public function getPpc() {
    return $this->ppc;
  }

  public function getTalla() {
    return $this->talla;
  }

  public function getAlimentacion() {
    return $this->alimentacion;
  }

  public function getObservacionesGenerales() {
    return $this->observaciones_generales;
  }

  public function getPaciente() {
    return PacienteRepository::getInstance()->get($this->paciente_id);
  }

  public function getUsuario() {
    return UsuarioRepository::getInstance()->getUserById($this->usuario_id);
  }

  public function getEdadSemanas($fecha){
    $paciente = $this->getPaciente();
    //var_dump($paciente);die;
    $datetime1 = new DateTime($paciente->getFechaNac());
    //  var_dump($datetime1);die;
    $datetime2 = new DateTime($fecha);
    $interval = $datetime1->diff($datetime2);
    // var_dump($paciente->getFechaNac());
    // var_dump($fecha);
    return(floor(($interval->format('%a') / 7)));die;
  }

}
