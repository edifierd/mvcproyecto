<?php

require_once('app/Config.php');
require_once('app/Autoload.php');
session_start();
//session_destroy();

$configuracion = ConfiguracionRepository::getInstance()->getById(1);
define('NOMBRE_HOSPITAL',$configuracion->getNombreHospital());
define('DESCRIPCION_HOSPITAL',$configuracion->getDescripcionHospital());
define('MAIL_HOSPITAL',$configuracion->getMailHospital());
define('ELEM_PAGINA',$configuracion->getElemPagina());
define('ESTADO_PAGINA',$configuracion->getEstadoPagina());


$request = new Request();
$nombre_controlador = $request->getControlador();
$controlador = $nombre_controlador."Controller";
$metodo = $request->getMetodo();
$parametros = $request->getParametros();


//En caso de que la pagina este deshabilitado
if (ESTADO_PAGINA == 0 && $nombre_controlador."_".$metodo == 'index_index'){
  $nombre_controlador = "index";
  $controlador = "indexController";
  $metodo = "modoMantenimiento";
}

//Control de autorización
if(!App::getInstance()->checkPermisions($nombre_controlador."_".$metodo)){
  $nombre_controlador = "index";
  $controlador = "indexController";
  $metodo = "sinPermisos";
  $parametro = null;
}


$rutaControlador = "src/controller/".$controlador.".php";

if(is_readable($rutaControlador)){

 require_once($rutaControlador);
  $controlador = new $controlador($nombre_controlador);

  if(!is_callable(array($controlador, $metodo))){
    $metodo = 'index';
  }


  if(isset($parametros)){
    call_user_func_array(array($controlador, $metodo), $parametros);
  }
  else{
    call_user_func(array($controlador, $metodo));
  }

}else{
  //var_dump($nombre_controlador."_".$metodo);
  header("HTTP/1.0 404 Not Found");
  die();
}
