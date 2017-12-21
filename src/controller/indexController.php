<?php


class indexController extends Controller {

  public function index(){
    if(App::getInstance()->current_user() != null){
        $this->redirect('index/indexAdmin');
    }
    $this->_view->render('index.html.twig');
  }

  public function indexAdmin(){
    $this->_view->render('indexAdmin.html.twig');
  }

  public function modoMantenimiento(){
    $this->_view->render('modoManteniento.html.twig');
  }

  public function sinPermisos(){
    $this->_view->render('sinPermisos.html.twig');
  }




}
