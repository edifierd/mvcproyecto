<?php


class Request {

  private $_controlador;
  private $_metodo;
  private $_parametros;

  public function __construct(){

    if (isset($_GET["url"])){
      $url = explode('/',$_GET["url"]);
      array_shift($url);
      $this->_controlador = strtolower(array_shift($url));
      $this->_metodo = strtolower(array_shift($url));
      $this->_parametros = $url;
    }

    if(!$this->_controlador){
        $this->_controlador = 'index';
    }

    if(!$this->_metodo){
        $this->_metodo = 'index';
    }

    if(!isset($this->_parametros)){
        $this->_parametros = array();
    }
  }

  public function getControlador(){
      return $this->_controlador;
  }

  public function getMetodo(){
      return $this->_metodo;
  }

  public function getParametros(){
      return $this->_parametros;
  }

}


?>
