<?php

class DatosDemograficosRepository extends PDORepository {

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
        $answer = $this->queryList("select * from datos_demograficos");
        //var_dump($answer);exit;
        $final_answer = [];
        foreach ($answer as &$element) {
            $final_answer[] = new DatoDemografico($element['id'], $element['electricidad'], $element['heladera'], $element['mascota'], $element['tipo_vivienda_id'], $element['tipo_agua_id'], $element['tipo_calefaccion_id'], $element['paciente_id']);
        }
        return $final_answer;
    }

    public function get($id) {
        $answer = $this->queryOne("select * from datos_demograficos where id=?;", [$id]);
        return new DatoDemografico($answer['id'], $answer['electricidad'], $answer['heladera'], $answer['mascota'], $answer['tipo_vivienda_id'], $answer['tipo_agua_id'], $answer['tipo_calefaccion_id'], $answer['paciente_id']);
    }

    public function delete($id)
    {
      $query = $this->query("delete from datos_demograficos where id = ? ",[$id]);
      return (boolean) $query;
    }

    //datos es un array con los datos a insertar
    public function insert($datos)
    {
        $query = $this->query("insert into datos_demograficos(heladera,electricidad,mascota,tipo_vivienda_id,tipo_calefaccion_id,tipo_agua_id,paciente_id) VALUES (?,?,?,?,?,?,?)",$datos);
        return (boolean) $query;
    }



    public function update($datos){

      $query = $this->query("update datos_demograficos set heladera =?, electricidad =?, mascota =?, tipo_vivienda_id=?, tipo_calefaccion_id = ?, tipo_agua_id =? where id=? ",$datos);
        return (boolean) $query;
      }

    public function getByPaciente($idp){
      $answer = $this->queryOne("SELECT * FROM datos_demograficos WHERE paciente_id = ?;",[$idp]);
      return new DatoDemografico($answer['id'], $answer['electricidad'], $answer['heladera'], $answer['mascota'], $answer['tipo_vivienda_id'], $answer['tipo_agua_id'], $answer['tipo_calefaccion_id'], $answer['paciente_id']);
    }

    public function getAgua(){
      $answer = $this->queryOne("SELECT * FROM datos_demograficos WHERE paciente_id = ?;",[$idp]);
      return new DatoDemografico($answer['id'], $answer['electricidad'], $answer['heladera'], $answer['mascota'], $answer['tipo_vivienda_id'], $answer['tipo_agua_id'], $answer['tipo_calefaccion_id'], $answer['paciente_id']);
    }

    public function getCantidadTipoAgua($id){
      return $this->queryCount("SELECT * FROM datos_demograficos WHERE tipo_agua_id = ?;",[$id]);
    }

    public function getCantidadMascota($id){
      return $this->queryCount("SELECT * FROM datos_demograficos WHERE mascota = ?;",[$id]);
    }


}
