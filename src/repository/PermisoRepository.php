<?php

class PermisoRepository extends PDORepository {

  private static $instance;

  public static function getInstance() {

    if (!isset(self::$instance)) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  private function __construct() {

  }

  public function getAllByRolId($id) {
    $answer = $this->queryList("select p.id, p.nombre from rol_tiene_permiso pr inner join permiso p ON pr.permiso_id = p.id where pr.rol_id =?;", [$id]);
    $final_answer = [];
    foreach ($answer as &$element) {
      $final_answer[] = new Permiso($element['id'], $element['nombre']);
    }
    return $final_answer;
  }



}
