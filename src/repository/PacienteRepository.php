<?php

class PacienteRepository extends PDORepository {

    private static $instance;

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {

    }

    public function listAll($nombreyapellido='',$tipo_documento='todos'){
      $datos = [];
      $cant_palabras = 0;
      $sql = "SELECT * FROM paciente where eliminado = 0 ";
      if ($nombreyapellido != '') {
        $nombreyapellido = str_replace(" ","%20",$nombreyapellido);
        $palabras = explode(" ", $nombreyapellido);
        $cant_palabras = sizeof($palabras);
        for ($i = 0; $i < $cant_palabras ; $i++) {
          $str_palabra = ':palabra'.$i;
          $sql = $sql." AND concat_ws(' ',nombre,apellido) LIKE ".$str_palabra;
          $datos[$str_palabra] = "%$palabras[$i]%";
        }
      }
       if ($tipo_documento != 'todos') {
         $sql = $sql." AND tipo_documento_id = :tipo_documento ";
       }
       $datos['tipo_documento'] = $tipo_documento;
      // var_dump($datos);
      // echo '<br>';
      // var_dump($sql);
      // die();
      $answer = $this->queryListPacientes($sql,$datos,$cant_palabras);
      $final_answer = [];
      foreach ($answer as &$query) {
        $final_answer[] = new Paciente($query['id'], $query['apellido'], $query['nombre'], $query['domicilio'], $query['telefono'], $query['fecha_nac'], $query['genero'], $query['numero_documento'], $query['obra_social_id'],
                                      $query['tipo_documento_id']);
      }
      return $final_answer;
    }

    public function listLimitPacientes($limite,$desde,$nombreyapellido='',$tipo_documento='todos'){
      $datos = [];
      $cant_palabras = 0;
      $sql = "SELECT * FROM paciente where eliminado = 0 ";
      if ($nombreyapellido != '') {
        $nombreyapellido = str_replace(" ","%20",$nombreyapellido);
        $palabras = explode(" ", $nombreyapellido);
        $cant_palabras = sizeof($palabras);
        for ($i = 0; $i < $cant_palabras ; $i++) {
          $str_palabra = ':palabra'.$i;
          $sql = $sql." AND concat_ws(' ',nombre,apellido) LIKE ".$str_palabra;
          $datos[$str_palabra] = "%$palabras[$i]%";
        }
      }

       if ($tipo_documento != 'todos') {
         $sql = $sql." AND tipo_documento_id = :tipo_documento ";
       }
      $datos['tipo_documento'] = $tipo_documento;
      $datos['limite'] = $limite;
      $datos['desde'] = $desde;

      $sql = $sql." ORDER BY id DESC LIMIT :limite OFFSET :desde ";
      // var_dump($datos);
      // echo '<br>';
      // var_dump($sql);
      // die();
      $answer = $this->queryLimitPacientes($sql,$datos,$cant_palabras);
      $final_answer = [];
      foreach ($answer as &$query) {
        $final_answer[] = new Paciente($query['id'], $query['apellido'], $query['nombre'], $query['domicilio'], $query['telefono'], $query['fecha_nac'], $query['genero'], $query['numero_documento'], $query['obra_social_id'],
                                      $query['tipo_documento_id']);
      }
      return $final_answer;
    }

    // public function listAll() {
    //     $answer = $this->queryList("select * from paciente where eliminado = 0 ");
    //     $final_answer = [];
    //     foreach ($answer as &$element) {
    //         $final_answer[] = new Paciente($element['id'], $element['nombre'], $element['apellido'], $element['domicilio'], $element['telefono'], $element['fecha_nac'], $element['genero'], $element['numero_documento'], $element['obra_social_id'],
    //                                       $element['tipo_documento_id']);
    //     }
    //     return $final_answer;
    // }

    public function get($id) {
        $answer = $this->queryOne("select * from paciente where id=?;", [$id]);
        if(!$answer){
          return null;
        }
        return new Paciente($answer['id'], $answer['apellido'], $answer['nombre'], $answer['domicilio'], $answer['telefono'], $answer['fecha_nac'], $answer['genero'], $answer['numero_documento'], $answer['obra_social_id'],
                                      $answer['tipo_documento_id']);
    }

    public function agregarPaciente($datos)
    {
      $query = $this->query("insert into paciente(apellido,nombre,domicilio,telefono,fecha_nac,genero,numero_documento,obra_social_id,tipo_documento_id) VALUES (?,?,?,?,?,?,?,?,?)",$datos);
      return (boolean) $query;
    }

    public function update($paciente){
      $query = $this->query(
        "update paciente
        set apellido =?,
        nombre =?,
        domicilio =?,
        telefono=?,
        fecha_nac=?,
        genero=?,
        numero_documento=?,
        obra_social_id=?,
        tipo_documento_id=?
        where id=? ",$paciente);
        return (boolean) $query;
      }


    public function listByTipoDocumento($tipo_documento)
    {
      $datos=[];
      $datos['tipo_documento'] = $tipo_documento;
      //$datos['tipo_documento'] = $tipo_documento;
      //var_dump($datos);die;

      //var_dump($tipo_documento);die;
      if($tipo_documento != 'todos')
      {
          $sql = "select * from paciente where tipo_documento_id = :tipo_documento";
          //echo $sql;exit;
      }else {
        $sql = "select * from paciente";
      }
      $answer = $this->queryListByDocument($sql,$datos);
      //var_dump($answer);die;
      if(!$answer){
        return null;
      }
      $final_answer = [];


        $final_answer[] = new Paciente($answer['id'], $answer['apellido'], $answer['nombre'], $answer['domicilio'], $answer['telefono'], $answer['fecha_nac'], $answer['genero'], $answer['numero_documento'], $answer['obra_social_id'],
                                      $answer['tipo_documento_id']);

      return $final_answer;
    }

    public function listByDocumento($numero,$tipo_documento='todos')
    {
      $datos=[];
      $sql = "select * from paciente where ((eliminado = 0) AND (numero_documento = :numero))";
      if(empty($numero) && $tipo_documento != 'todos')
      {
        $numero = 1;
        $sql = $sql." OR (tipo_documento_id = :tipo_documento)";
      }elseif (!empty($numero) && $tipo_documento != 'todos') {
          $sql = $sql." AND (tipo_documento_id = :tipo_documento)";
      }
      //var_dump($tipo_documento);var_dump($numero);die;;
      $datos['numero'] = $numero;
      $datos['tipo_documento'] = $tipo_documento;
      //var_dump($datos);die;

      //var_dump($tipo_documento);die;

      $answer = $this->queryListByDocument($sql,$datos);
      if(!$answer){
        return null;
      }
      $final_answer = [];

        foreach ($answer as &$element) {
          $final_answer[] = new Paciente($element['id'], $element['apellido'], $element['nombre'], $element['domicilio'], $element['telefono'], $element['fecha_nac'], $element['genero'], $element['numero_documento'], $element['obra_social_id'],
                                        $element['tipo_documento_id']);
        }


      return $final_answer;
    }

    public function getByDocumento($numero)
    {
      $query = $this->queryOne("select * from paciente where numero_documento = ? ",[$numero]);
      if(!$query){
        return null;
      }
       return new Paciente($query['id'], $query['apellido'], $query['nombre'], $query['domicilio'], $query['telefono'], $query['fecha_nac'], $query['genero'], $query['numero_documento'], $query['obra_social_id'],
                                    $query['tipo_documento_id']);

    }

    public function setEliminado($id,$eliminado){
      $answer = $this->query("update paciente set eliminado =? where id=? ", [$eliminado,$id]);
      return (boolean) $answer;
    }

    public function queryLimitPacientes($sql, $args = array(),$cant_palabras){
      $connection = $this->getConnection();
      $stmt = $connection->prepare($sql);
      $stmt->bindValue(':limite', $args['limite'], PDO::PARAM_INT);
      $stmt->bindValue(':desde', $args['desde'], PDO::PARAM_INT);
       if($args['tipo_documento'] != 'todos'){
         $stmt->bindValue(':tipo_documento', $args['tipo_documento'], PDO::PARAM_INT);
       }
      for ($i = 0; $i < $cant_palabras ; $i++) {
        $str_palabra = ':palabra'.$i;
        $stmt->bindValue($str_palabra, $args[$str_palabra], PDO::PARAM_INT);
      }
      $stmt->execute();
      return $stmt->fetchAll();
    }

    public function queryListPacientesByTP($sql,$args = array())
    {
        $connection = $this->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':limite', $args['limite'], PDO::PARAM_INT);
        $stmt->bindValue(':desde', $args['desde'], PDO::PARAM_INT);
       if($args['tipo_documento'] != 'todos'){
         $stmt->bindValue(':tipo_documento', $args['tipo_documento'], PDO::PARAM_INT);
       }

       $stmt->execute();
       return $stmt->fetchAll();
    }

    protected function queryListPacientes($sql, $args = array(),$cant_palabras){
      $connection = $this->getConnection();
      $stmt = $connection->prepare($sql);
       if($args['tipo_documento'] != 'todos'){
         $stmt->bindValue(':tipo_documento', $args['tipo_documento'], PDO::PARAM_INT);
       }
      for ($i = 0; $i < $cant_palabras ; $i++) {
        $str_palabra = ':palabra'.$i;
        $stmt->bindValue($str_palabra, $args[$str_palabra], PDO::PARAM_INT);
      }
      $stmt->execute();
      return $stmt->fetchAll();
    }

}
