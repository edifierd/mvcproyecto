<?php

abstract class PDORepository {

  const USERNAME = USERNAME;
  const PASSWORD = PASSWORD;
  const HOST = HOST;
  const DB = DB;


  public function getConnection(){
    $u=self::USERNAME;
    $p=self::PASSWORD;
    $db=self::DB;
    $host=self::HOST;

    $connection = new PDO("mysql:dbname=$db;host=$host", $u, $p,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    return $connection;
  }

  protected function queryList($sql, $args = array()){
    $connection = $this->getConnection();
    $stmt = $connection->prepare($sql);
    $stmt->execute($args);
    return $stmt->fetchAll();
  }

  protected function queryOne($sql, $args = array()){
    $connection = $this->getConnection();
    $stmt = $connection->prepare($sql);
    $stmt->execute($args);
    return $stmt->fetch();
  }


  //consulta generica para insert, delete y update
  protected function query($sql, $args = array()){
    $connection = $this->getConnection();
    $stmt = $connection->prepare($sql);
    $stmt->execute($args);
    return $stmt->rowCount();
  }

  protected function queryListByDocument($sql,$args=array())
  {
    $connection = $this->getConnection();
    $stmt = $connection->prepare($sql);
    //var_dump($args);die;
    $stmt->bindValue(':numero', $args['numero'], PDO::PARAM_INT);
    //var_dump($stmt);die;
    if($args['tipo_documento'] != 'todos')
    {
      $stmt->bindValue(':tipo_documento', $args['tipo_documento'], PDO::PARAM_INT);
    }
    $stmt->execute();
    return $stmt->fetchAll();
  }

  protected function queryGetByPaciente($sql,$idP)
  {
    $connection = $this->getConnection();
    $stmt = $connection->prepare($sql);

  }

  protected function queryCount($sql,$args){
    $connection = $this->getConnection();
    $stmt = $connection->prepare($sql);
    $stmt->execute($args);
    return $stmt->rowCount();
  }





}
