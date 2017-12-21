<?php

class RolRepository extends PDORepository {

  private static $instance;

  public static function getInstance() {

    if (!isset(self::$instance)) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  private function __construct() {

  }

  public function addRoleToUser($id,$rol){
    $query = $this->query("insert into usuario_tiene_rol(usuario_id,rol_id) VALUES (?,?)",[$id,$rol]);
    return (boolean) $query;
  }

  public function destroyRoleToUser($id,$rol){
    $query = $this->query("delete from usuario_tiene_rol where usuario_id =? and rol_id =?",[$id,$rol]);
    return (boolean) $query;
  }

  public function listAll(){
    $answer = $this->queryList("select * from rol");
    $final_answer = [];
    foreach ($answer as &$element) {
      $final_answer[] = new Rol($element['id'], $element['nombre']);
    }
    return $final_answer;
  }

  public function getAllByUserId($id) {
    $answer = $this->queryList("select * from usuario_tiene_rol ur inner join rol r on r.id = ur.rol_id where ur.usuario_id =?;", [$id]);
    $final_answer = [];
    foreach ($answer as &$element) {
      $final_answer[] = new Rol($element['id'], $element['nombre']);
    }
    return $final_answer;
  }




}
