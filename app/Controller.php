<?php


abstract class Controller {

  protected $_view;

  public function __construct($controlador){
    $this->_view = new View($controlador);
  }

  abstract public function index();

  public function getFlashBag(){
    return FlashMsj::getInstance();
  }

  public function redirect($ruta){
    header('Location: '.BASE_URL.$ruta);
    die();
  }


}





?>
