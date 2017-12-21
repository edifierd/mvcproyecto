<?php


class FlashMsj {

  private static $instance;

  public static function getInstance() {

      if (!isset(self::$instance)) {
          self::$instance = new self();
      }

      return self::$instance;
  }

  private function __construct() {
    if(!isset($_SESSION['msj'])){
      $_SESSION['msj']['success'] = array();
      $_SESSION['msj']['info'] = array();
      $_SESSION['msj']['warning'] = array();
      $_SESSION['msj']['danger'] = array();
    }
  }

  public function getMsj($tipo){
    $rta = $_SESSION['msj'][$tipo];
    $_SESSION['msj'][$tipo] = array();
    return $rta;
  }

  public function setMsj($tipo,$texto){
    $_SESSION['msj'][$tipo][] = $texto;
  }

  public function isEmpty($tipo){
    return sizeof($_SESSION['msj'][$tipo]) > 0;
  }

}




?>
