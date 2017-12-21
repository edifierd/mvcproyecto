<?php


class View  {

  private $_twig;
  private $_controlador;

  public function __construct($controlador){
    $this->_controlador = $controlador;
    Twig_Autoloader::register();
    $loader = new Twig_Loader_Filesystem('src/resource/views');
    //$this->twig = new Twig_Environment($loader, array('cache' => __DIR__ .'/cache','auto_reload'=>DESA));
    $this->_twig = new Twig_Environment($loader,array('debug' => true));
    $this->_twig->addExtension(new Twig_Extension_Debug());

    $this->_twig->addGlobal('BASE_URL',BASE_URL);
    $this->_twig->addGlobal('BASE_URL_INC',BASE_URL_INC);
    $this->_twig->addGlobal('JS_BASE_URL',BASE_URL_INC.'src/resource/views/'.$controlador.'/js');
    $this->_twig->addGlobal('CSS_BASE_URL',BASE_URL_INC.'src/resource/views/'.$controlador.'/css');
    $this->_twig->addGlobal('NOMBRE_HOSPITAL',NOMBRE_HOSPITAL);
    $this->_twig->addGlobal('DESCRIPCION_HOSPITAL',DESCRIPCION_HOSPITAL);
    $this->_twig->addGlobal('MAIL_HOSPITAL',MAIL_HOSPITAL);
    $this->_twig->addGlobal('ELEM_PAGINA',ELEM_PAGINA);
    $this->_twig->addGlobal('ESTADO_PAGINA',ESTADO_PAGINA);
    $this->_twig->addGlobal('flashBag',FlashMsj::getInstance());
    $this->_twig->addGlobal('app',App::getInstance());

  }

  public function render($view, $resource = array()) {
      echo $this->_twig->render('/'.$this->_controlador.'/'.$view, $resource);
  }


}



?>
