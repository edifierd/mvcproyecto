<?php

class ViviendaRepository extends PDORepository {

  private static $instance;

  public static function getInstance() {

    if (!isset(self::$instance)) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  private function __construct() {

  }



  public function listAll() {
    return CurlRequest::getTipo("https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-vivienda");
    // $answer = $this->queryList("select * from tipo_vivienda");
    // $final_answer = [];
    // foreach ($answer as &$element) {
    //     $final_answer[] = new Vivienda($element['id'], $element['nombre']);
    // }
    // return $final_answer;
  }

  public function getById($id) {
    return CurlRequest::getTipo("https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-vivienda/" . $id);
    // $answer = $this->queryOne("select * from tipo_vivienda where id=?;", [$id]);
    // return new Vivienda($answer['id'], $answer['nombre'] );
  }

}
