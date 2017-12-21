<?php

  class ControlSaludRepository extends PDORepository
  {
    private static $instancia;

    public static function getInstance()
    {
      if(!isset(self::$instancia))
      {
        self::$instancia = new Self();
      }
      return self::$instancia;
    }

    public function insert($datos)
    {

      $query = $this->query("INSERT INTO control_salud(fecha,peso,vacunas_completas,maduracion_acorde,maduracion_observaciones,ex_fisico_normal,ex_fisico_observaciones,pc,ppc,talla,alimentacion,observaciones_generales,paciente_id,usuario_id)
          VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)",$datos);

      return (boolean) $query;
    }

    public function listAll(){

      $sql = "SELECT * FROM control_salud where eliminado = 0 ";

      $answer = $this->queryList($sql);
      $final_answer = [];
      foreach ($answer as &$query) {
        $final_answer[] = new ControlSalud($query['id'], $query['fecha'], $query['peso'], $query['vacunas_completas'], $query['maduracion_acorde'], $query['maduracion_observaciones'],$query['ex_fisico_normal'], $query['ex_fisico_observaciones'], $query['pc'],
                                      $query['ppc'],$query['talla'],$query['alimentacion'],$query['observaciones_generales'],$query['paciente_id'],$query['usuario_id']);
      }
      return $final_answer;
    }

    public function get($id)
    {
      $query = "SELECT * FROM control_salud WHERE id = ? AND eliminado = 0";
      $answer = $this->queryOne($query,[$id]);
      //var_dump($answer);die;
      //var_dump($answer['edad']);die;

        return new ControlSalud($answer['id'], $answer['fecha'], $answer['peso'], $answer['vacunas_completas'], $answer['maduracion_acorde'], $answer['maduracion_observaciones'],$answer['ex_fisico_normal'], $answer['ex_fisico_observaciones'], $answer['pc'],
                                      $answer['ppc'],$answer['talla'],$answer['alimentacion'],$answer['observaciones_generales'],$answer['paciente_id'],$answer['usuario_id']);

    }


    public function getByPacienteId($paciente_id){
      $answer = $this->queryList("SELECT * FROM control_salud WHERE paciente_id = ? AND eliminado = 0  ORDER BY fecha",[$paciente_id]);
      $final_answer = [];
      foreach ($answer as &$query) {
        $final_answer[] = new ControlSalud(
          $query['id'],
          $query['fecha'],
          $query['peso'] ,
          $query['vacunas_completas'],
          $query['maduracion_acorde'],
          $query['maduracion_observaciones'],
          $query['ex_fisico_normal'],
          $query['ex_fisico_observaciones'],
          $query['pc'],
          $query['ppc'],
          $query['talla'],
          $query['alimentacion'],
          $query['observaciones_generales'],
          $query['paciente_id'],
          $query['usuario_id']
        );
      }
      return $final_answer;
    }

    public function update($control)
    {
      $query = $this->query(
        "update control_salud
        set fecha =?,
        peso =?,
        vacunas_completas =?,
        maduracion_acorde=?,
        maduracion_observaciones=?,
        ex_fisico_normal=?,
        ex_fisico_observaciones=?,
        pc=?,
        ppc=?,
        talla=?,
        alimentacion=?,
        observaciones_generales=?
        where id=? ",$control);
        return (boolean) $query;
    }

    public function setEliminado($id,$eliminado)
    {
      $answer = $this->query("update control_salud set eliminado =? where id=? ", [$eliminado,$id]);
      return (boolean) $answer;
    }



  }


?>
