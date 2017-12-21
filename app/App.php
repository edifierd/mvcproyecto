<?php


class App {

  private static $instance;
  protected $_rutasVisitante;

  public static function getInstance() {

      if (!isset(self::$instance)) {
          self::$instance = new self();
      }

      return self::$instance;
  }

  public function __construct(){
    $this->_rutasVisitante = array('index_index','usuario_login','index_modoMantenimiento','telegram_hook');
  }

  public function checkPermisions($action){
    if($this->current_user() == null){
      foreach ($this->_rutasVisitante as $value) {
        if($value == $action){
          return true;
        }
      }
    }else{
      $roles = $this->current_user()->getRol();
      foreach ( $roles as $rol) {
        $permisos = $rol->getPermisos();
        foreach ($permisos as $permiso) {
          if ($permiso->getNombre() == $action){
            return true;
          }
        }
      }
    }
    return false;
  }

  public function current_user(){
    if(isset($_SESSION['current_user'])){
      return  $_SESSION['current_user'];
    }
    return null;
  }

}





?>
