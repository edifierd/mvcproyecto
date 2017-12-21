<?php

class ConfiguracionRepository extends PDORepository {

    private static $instance;

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {

    }

    public function getById($id) {
        $answer = $this->queryList("select * from configuracion where id=?;", [$id]);

        $answer = $answer[0];

        return new Configuracion($answer['nombre_hospital'],$answer['descripcion_hospital'],$answer['mail_hospital'],$answer['elem_pagina'],$answer['estado_pagina'] );
    }

    public function update($nombre_hospital,$descripcion_hospital,$mail_hospital,$elem_pagina,$estado_pagina){
      $rta = $this->query(
        "update configuracion set nombre_hospital = ?, descripcion_hospital = ?, mail_hospital = ?, elem_pagina = ? , estado_pagina = ? where id = 1 ",
        [$nombre_hospital,$descripcion_hospital,$mail_hospital,$elem_pagina,$estado_pagina]
      );
      return (boolean) $rta;
    }

}
