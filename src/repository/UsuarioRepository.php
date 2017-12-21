<?php

class UsuarioRepository extends PDORepository {

  private static $instance;

  public static function getInstance() {

    if (!isset(self::$instance)) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  private function __construct() {}

    public function listAll($nombreyapellido='',$estado='todos'){
      $datos = [];
      $cant_palabras = 0;
      $sql = "SELECT * FROM usuario where eliminado = 0 ";
      if ($nombreyapellido != '') {
        $nombreyapellido = str_replace(" ","%20",$nombreyapellido);
        $palabras = explode(" ", $nombreyapellido);
        $cant_palabras = sizeof($palabras);
        for ($i = 0; $i < $cant_palabras ; $i++) {
          $str_palabra = ':palabra'.$i;
          $sql = $sql." AND concat_ws(' ',first_name,last_name) LIKE ".$str_palabra;
          $datos[$str_palabra] = "%$palabras[$i]%";
        }
      }
      if ($estado != 'todos') {
        $sql = $sql." AND activo = :estado ";
      }
      $datos['estado'] = $estado;
      // var_dump($datos);
      // echo '<br>';
      // var_dump($sql);
      // die();
      $answer = $this->queryListUser($sql,$datos,$cant_palabras);
      $final_answer = [];
      foreach ($answer as &$element) {
        $final_answer[] = new Usuario($element['id'], $element['email'], $element['password'], $element['activo'], $element['updated_at'], $element['created_at'], $element['first_name'], $element['last_name']);
      }
      return $final_answer;
    }

    public function listLimitUsers($limite,$desde,$nombreyapellido='',$estado='todos'){
      $datos = [];
      $cant_palabras = 0;
      $sql = "SELECT * FROM usuario where eliminado = 0 ";
      if ($nombreyapellido != '') {
        $nombreyapellido = str_replace(" ","%20",$nombreyapellido);
        $palabras = explode(" ", $nombreyapellido);
        $cant_palabras = sizeof($palabras);
        for ($i = 0; $i < $cant_palabras ; $i++) {
          $str_palabra = ':palabra'.$i;
          $sql = $sql." AND concat_ws(' ',first_name,last_name) LIKE ".$str_palabra;
          $datos[$str_palabra] = "%$palabras[$i]%";
        }
      }
      if ($estado != 'todos') {
        $sql = $sql." AND activo = :estado ";
      }
      $datos['estado'] = $estado;
      $datos['limite'] = $limite;
      $datos['desde'] = $desde;
      $sql = $sql." ORDER BY id DESC LIMIT :limite OFFSET :desde ";
      // var_dump($datos);
      // echo '<br>';
      // var_dump($sql);
      // die();
      $answer = $this->queryLimitUsers($sql,$datos,$cant_palabras);
      $final_answer = [];
      foreach ($answer as &$element) {
        $final_answer[] = new Usuario($element['id'], $element['email'], $element['password'], $element['activo'], $element['updated_at'], $element['created_at'], $element['first_name'], $element['last_name']);
      }
      return $final_answer;
    }

    public function validateUser($email,$password){
      $answer = $this->queryOne("select * from usuario where email=? AND password =? AND eliminado = 0 AND activo = 1", [$email,$password]);
      if(empty($answer)){
        return null;
      }
      return new Usuario($answer['id'], $answer['email'], $answer['password'], $answer['activo'], $answer['updated_at'], $answer['created_at'], $answer['first_name'], $answer['last_name']);
    }

    public function create($nombre,$apellido,$email,$password){
      $datos = array($email,$password,date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),$nombre,$apellido);
      $query = $this->query("insert into usuario(email,password,activo,created_at,updated_at,first_name,last_name,eliminado) VALUES (?,?,1,?,?,?,?,1)",$datos);
      return (boolean) $query;
    }

    public function update($id,$nombre,$apellido,$password){
      $datos = array($nombre,$apellido,$password,date('Y-m-d H:i:s'),$id);
      $query = $this->query(
        "update usuario
        set first_name =?,
        last_name =?,
        password =?,
        updated_at=?
        where id=? ",$datos);
        return (boolean) $query;
      }

      //GETTERS AND SETTERS
      public function getUserById($id) {
        $answer = $this->queryOne("select * from usuario where id=? AND eliminado = 0", [$id]);
        if(!$answer){
          return null;
        }
        return new Usuario($answer['id'], $answer['email'], $answer['password'], $answer['activo'], $answer['updated_at'], $answer['created_at'], $answer['first_name'], $answer['last_name'],$answer['eliminado']);
      }

      public function getUserByEmail($email) {
        $answer = $this->queryOne("select * from usuario where email=?", [$email]);
        if(!$answer){
          return null;
        }
        return new Usuario($answer['id'], $answer['email'], $answer['password'], $answer['activo'], $answer['updated_at'], $answer['created_at'], $answer['first_name'], $answer['last_name'],$answer['eliminado']);
      }

      public function setActivo($id, $activo){
        $answer = $this->query("update usuario set activo =?, updated_at=? where id=? AND eliminado = 0", [$activo,date('Y-m-d H:i:s'),$id]);
        return (boolean) $answer;
      }

      public function setEliminado($id,$eliminado){
        $answer = $this->query("update usuario set eliminado =?, updated_at=? where id=? ", [$eliminado,date('Y-m-d  H:i:s'),$id]);
        return (boolean) $answer;
      }

      //protected function

      protected function queryLimitUsers($sql, $args = array(),$cant_palabras){
        $connection = $this->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':limite', $args['limite'], PDO::PARAM_INT);
        $stmt->bindValue(':desde', $args['desde'], PDO::PARAM_INT);
        if($args['estado'] != 'todos'){
          $stmt->bindValue(':estado', $args['estado'], PDO::PARAM_INT);
        }
        for ($i = 0; $i < $cant_palabras ; $i++) {
          $str_palabra = ':palabra'.$i;
          $stmt->bindValue($str_palabra, $args[$str_palabra], PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll();
      }

      protected function queryListUser($sql, $args = array(),$cant_palabras){
        $connection = $this->getConnection();
        $stmt = $connection->prepare($sql);
        if($args['estado'] != 'todos'){
          $stmt->bindValue(':estado', $args['estado'], PDO::PARAM_INT);
        }
        for ($i = 0; $i < $cant_palabras ; $i++) {
          $str_palabra = ':palabra'.$i;
          $stmt->bindValue($str_palabra, $args[$str_palabra], PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll();
      }

      // public function listLimit($limite,$desde){
      //   $answer = $this->queryLimit("SELECT * FROM usuario where eliminado = 0 ORDER BY id DESC LIMIT :limite OFFSET :desde ",['limite' => $limite,'desde' => $desde]);
      //   $final_answer = [];
      //   foreach ($answer as &$element) {
      //     $final_answer[] = new Usuario($element['id'], $element['email'], $element['password'], $element['activo'], $element['updated_at'], $element['created_at'], $element['first_name'], $element['last_name']);
      //   }
      //   return $final_answer;
      // }

      // public function listAll(){
      //   $answer = $this->queryList("select * from usuario where eliminado = 0");
      //   $final_answer = [];
      //   foreach ($answer as &$element) {
      //     $final_answer[] = new Usuario($element['id'], $element['email'], $element['password'], $element['activo'], $element['updated_at'], $element['created_at'], $element['first_name'], $element['last_name']);
      //   }
      //   return $final_answer;
      // }

    }
