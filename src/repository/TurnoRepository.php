<?php

class TurnoRepository extends PDORepository {

  private static $instance;

  public static function getInstance() {

    if (!isset(self::$instance)) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  private function __construct() {}


    //GETTERS AND SETTERS
    public function getTurnosLibres($fecha) {
      $answer = $this->queryList("select * from horarios h where not exists (select * from turnos t where t.id_horario = h.id AND fecha = ? ) ", [$fecha]);
      $final_answer = [];
      foreach ($answer as &$element) {
        $final_answer[] = new Horario($element['id'], $element['nombre']);
      }
      return $final_answer;
    }

    public function getTurno($fecha,$horario_id) {
      $answer = $this->queryList("select * from turnos t where t.id_horario = ? and t.fecha = ? ;", [$horario_id,$fecha]);
      if(empty($answer)){
        return null;
      }
      $final_answer = [];
      foreach ($answer as &$element) {
        $final_answer[] = new Horario($element['id'], $element['nombre']);
      }
      return $final_answer;
    }

    public function setTurno($fecha,$horario_id,$dni) {
      $query = $this->query("INSERT INTO turnos (id_horario,fecha,dni) VALUES (?,?,?);", [$horario_id,$fecha,$dni]);
      return (boolean) $query;
    }




  }
