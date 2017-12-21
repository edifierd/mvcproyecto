<?php

class CalefaccionRepository extends PDORepository {

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
      return CurlRequest::getTipo("https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-calefaccion");
        // $answer = $this->queryList("select * from tipo_calefaccion");
        // $final_answer = [];
        // foreach ($answer as &$element) {
        //     $final_answer[] = new Calefaccion($element['id'], $element['nombre']);
        // }
        // return $final_answer;
    }

    public function getById($id) {
      return CurlRequest::getTipo("https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-calefaccion/" . $id);
        // $answer = $this->queryOne("select * from tipo_calefaccion where id=?;", [$id]);
        // return new Calefaccion($answer['id'], $answer['nombre'] );
    }

}
