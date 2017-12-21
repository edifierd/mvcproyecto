<?php

class Documento {

    private $id;
    private $tipo;



    public function __construct($id, $tipo) {
        $this->id = $id;
        $this->tipo = $tipo;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->tipo;
    }



}
