<?php

class ObraSocial {

    private $id;
    private $nombre;



    public function __construct($id, $nombre) {
        $this->id = $id;
        $this->nombre = $nombre;

    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }


}
