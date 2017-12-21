<?php


class configuracionController extends Controller {

  public function index(){
  }

  public function update(){
    $retorno = array();
    if(isset($_POST['nombre_hospital']) && isset($_POST['descripcion_hospital']) && isset($_POST['mail_hospital']) && isset($_POST['elem_pagina']) && isset($_POST['estado_pagina'])){
      $nombre_hospital = htmlspecialchars(trim($_POST['nombre_hospital']));
      $descripcion_hospital = htmlspecialchars(trim($_POST['descripcion_hospital']));
      $mail_hospital = htmlspecialchars(trim($_POST['mail_hospital']));
      $elem_pagina = htmlspecialchars(trim($_POST['elem_pagina']));
      $estado_pagina =htmlspecialchars(trim( $_POST['estado_pagina']));
      if(!empty($nombre_hospital) && !empty($descripcion_hospital) && !empty($mail_hospital) && !empty($elem_pagina) && !empty($estado_pagina)){
        $rta = ConfiguracionRepository::getInstance()->update($nombre_hospital,$descripcion_hospital,$mail_hospital,$elem_pagina,$estado_pagina);
        if($rta){
          $this->getFlashBag()->setMsj('success','Se ha actualizado correctamente.');
        }else{
          $this->getFlashBag()->setMsj('danger','Ha ocurrido un error intente nuevamente.');
        }
      } else {
        $this->getFlashBag()->setMsj('warning','Todos los datos son requeridos.');
      }
    }
    $configuracion = ConfiguracionRepository::getInstance()->getById(1);
    $retorno['configuracion'] = $configuracion;
    $this->_view->render('update.html.twig',$retorno);
  }



}
