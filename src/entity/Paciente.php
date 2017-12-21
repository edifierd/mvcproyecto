<?php

class Paciente {

    public $id;
    public $nombre;
    public $apellido;
    public $domicilio;
    public $telefono;
    public $fecha_nac;
    public $genero;
    public $obra_social;
    public $tipo_documento;
    public $numero_documento;


    public function __construct($id, $apellido, $nombre, $domicilio, $telefono, $fecha_nac, $genero, $numero, $obra_social_id, $tipo_documento) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->domicilio = $domicilio;
        $this->telefono = $telefono;
        $this->fecha_nac = $fecha_nac;
        $this->genero = $genero;
        $this->numero_documento = $numero;
        $this->obra_social = $obra_social_id;
        $this->tipo_documento = $tipo_documento;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getDomicilio() {
        return $this->domicilio;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getFechaNac() {
        return $this->fecha_nac;
    }

    public function getGenero() {
        return $this->genero;
    }

    public function getNumeroDocumento() {
        return $this->numero_documento;
    }

    public function getDatosDemograficos(){
      return DatosDemograficosRepository::getInstance()->get($this->id);
    }

    public function getTipoDocumento()
    {
      return DocumentoRepository::getInstance()->get($this->tipo_documento);
    }

    public function getObraSocial() {
        return ObraSocialRepository::getInstance()->get($this->obra_social);
    }

    public function getControlSalud() {
        return ControlSaludRepository::getInstance()->getByPacienteId($this->getId());
    }



    public function getEdad()
    {
      //date in mm/dd/yyyy format; or it can be in other formats as well
      $dateOfBirth = $this->getFechaNac();
      $today = date("Y-m-d");
      $diff = date_diff(date_create($dateOfBirth), date_create($today));
      return (int)$diff->format('%y');

    }

}
