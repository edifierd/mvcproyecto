<?php

class Configuracion {

    protected $nombre_hospital;
    protected $descripcion_hospital;
    protected $mail_hospital;
    protected $elem_pagina;
    protected $estado_pagina;

    public function __construct($nombre_hospital,$descripcion_hospital,$mail_hospital,$elem_pagina,$estado_pagina) {
      $this->nombre_hospital = $nombre_hospital;
      $this->descripcion_hospital = $descripcion_hospital;
      $this->mail_hospital = $mail_hospital;
      $this->elem_pagina = $elem_pagina;
      $this->estado_pagina = $estado_pagina;
    }

    public function getNombreHospital() {
        return $this->nombre_hospital;
    }

    public function getDescripcionHospital() {
        return $this->descripcion_hospital;
    }

    public function getMailHospital() {
        return $this->mail_hospital;
    }

    public function getElemPagina() {
        return $this->elem_pagina;
    }

    public function getEstadoPagina() {
        return $this->estado_pagina;
    }
}
