<?php

class ObraSocialRepository extends PDORepository {

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
    return CurlRequest::getTipo("https://api-referencias.proyecto2017.linti.unlp.edu.ar/obra-social");
    // $answer = $this->queryList("select * from obra_social");
    // //var_dump($answer);exit;
    // $final_answer = [];
    // foreach ($answer as &$element) {
    //     $final_answer[] = new ObraSocial($element['id'], $element['nombre']);
    // }
    // return $final_answer;
  }

  public function get($id) {
    return CurlRequest::getTipo("https://api-referencias.proyecto2017.linti.unlp.edu.ar/obra-social/" . $id);
    // $answer = $this->queryOne("select * from obra_social where id=?;", [$id]);
    // return new ObraSocial($answer['id'], $answer['nombre']);
  }
  /*
  //datos es un array con los datos a insertar
  public function insert($datos)
  {
  $query = $this->query("insert into datos_demograficos(heladera,electricidad,mascota,tipo_vivienda_id,tipo_calefaccion_id,tipo_agua_id) VALUES (?,?,?,?,?,?)",$datos['heladera'],$datos['electricidad'],$datos['mascota'],$datos['tipo_vivienda_id'],$datos['tipo_calefaccion_id'],$datos['tipo_agua_id']);
  return (boolean) $query;
}

public function update($datos,$id)
{
$query = $this->query("UPDATE datos_demograficos SET
heladera=?,
electricidad=?,
mascota=?,
tipo_vivienda_id=?,
tipo_calefaccion_id=?,
tipo_agua_id=?
where id = ?",$datos['heladera'],$datos['electricidad'],$datos['mascota'],$datos['tipo_vivienda_id'],$datos['tipo_calefaccion_id'],$datos['tipo_agua_id'],[$id]);

return (boolean) $query;
}*/

}
