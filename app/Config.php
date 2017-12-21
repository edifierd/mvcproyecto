<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

define('DESA',true);

//CONFIGURACIÓN DE LA BASE
define('USERNAME', 'grupo36');
define('PASSWORD', 'OGU5NGFhNmI5Njgw');
define('HOST', 'localhost');
define('DB', 'grupo36');


//CONFIGURACIÓN DE LA RUTA BASE
$url = $_SERVER['SERVER_NAME'];
if($url == 'localhost'){
  $url = 'http://'.$url.'/proyecto/';
}else{
  $url = 'https://'.$url.'/';
}
define('BASE_URL_INC', $url);
define('BASE_URL', $url."application/");

?>
