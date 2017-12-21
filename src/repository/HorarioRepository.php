<?php

class HorarioRepository extends PDORepository {

  private static $instance;

  public static function getInstance() {

    if (!isset(self::$instance)) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  private function __construct() {}


    //GETTERS AND SETTERS
    public function getHorarioByNombre($nombre) {
      $element = $this->queryOne("select * from horarios where nombre = ? ;", [$nombre]);
      if(empty($element)){
        return null;
      }
      return new Horario($element['id'], $element['nombre']);
    }




  }
