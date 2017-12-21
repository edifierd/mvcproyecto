<?php

/*

Muchos desarrolladores que escriben aplicaciones orientadas a objetos crean un fichero fuente de PHP para cada definición de clase.
Una de las mayores molestias es tener que hacer una larga lista de inclusiones al comienzo de cada script (uno por cada clase).

En PHP 5 esto ya no es necesario. La función spl_autoload_register() registra cualquier número de autocargadores, posibilitando
que las clases e interfaces sean cargadas automáticamente si no están definidas actualmente. Al registrar autocargadores, a PHP
se le da una última oportunidad de cargar las clases o interfaces antes de que falle por un error.

*/

//Include twig
//Include slim fremework
require_once './vendor/autoload.php';

spl_autoload_register(function ($class) {

  if(file_exists("app/" . $class . '.php')){
    include_once "app/" . $class . '.php';
    //echo "Se incluyo: "."app/" . $class . '.php'."<br />";

  }elseif(file_exists("src/repository/" . $class . '.php')){
    include_once "src/repository/" . $class . '.php';
    //echo "Se incluyo:". "src/repository/" . $class . '.php'."<br />";

  }elseif(file_exists("src/entity/" . $class . '.php')){
    include_once "src/entity/" . $class . '.php';
    //echo "Se incluyo:". "src/entity/" . ucfirst(strtolower($class)) . '.php'."<br />";
  }else{
    //echo "No inluido: ".$class."<br />";
  }

});


?>
