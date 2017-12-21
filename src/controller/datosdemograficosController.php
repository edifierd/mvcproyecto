<?php


class datosdemograficosController extends Controller {

  public function index(){
    $datosDemograficos = DatosDemograficosRepository::getInstance()->listAll();
    $resources = array('datosDemograficos' => $datosDemograficos);
    $this->_view->render('index.html.twig',$resources);
  }

  public function graficos(){
    $this->_view->render('graficos.html.twig');
  }

  public function getEstadisticaTipoAgua(){
    $agua = AguaRepository::getInstance()->listAll();
    $rta = array();
    foreach ($agua as $value) {
      $rta[] = array("tipo" => $value->nombre, "cantidad" => DatosDemograficosRepository::getInstance()->getCantidadTipoAgua($value->id));
    }
    echo json_encode($rta);
  }

  public function getEstadisticaMascota(){
    $rta = array();
    $rta['si'] = DatosDemograficosRepository::getInstance()->getCantidadMascota(1);
    $rta['no'] = DatosDemograficosRepository::getInstance()->getCantidadMascota(0);
    echo json_encode($rta);
  }


  public function insertarDatoDemografico()
  {
    if(isset($_POST['heladera']) && isset($_POST['electricidad']) && isset($_POST['mascota']) && isset ($_POST['vivienda']) && isset($_POST['calefaccion']) && isset($_POST['agua']))
    {

      $datosDemograficos[0] = strip_tags(trim($_POST['heladera']));
      $datosDemograficos[1] = strip_tags(trim($_POST['electricidad']));
      $datosDemograficos[2] = strip_tags(trim($_POST['mascota']));
      $datosDemograficos[3] = strip_tags(trim($_POST['vivienda']));
      $datosDemograficos[4] = strip_tags(trim($_POST['calefaccion']));
      $datosDemograficos[5] = strip_tags(trim($_POST['agua']));

      if($rta = DatosDemograficosRepository::getInstance()->insert($datosDemograficos));
      {
        $this->getFlashBag()->setMsj('success','Datos Demográficos añadidos correctamente.');
        $this->redirect('datosDemograficos/index');
      }
    }else
    {
      $this->getFlashBag()->setMsj('danger','Debe completar todos los campos');
      $this->redirect('datosDemograficos/index');
    }

  }

  public function eliminar($id)
  {
    $datoDemografico = DatosDemograficosRepository::getInstance()->get($id);
    $resource = array('datoDemografico' => $datoDemografico);
    $this->_view->render('eliminar.html.twig',$resource);
  }

  public function show($id)
  {
    $datoDemografico = DatosDemograficosRepository::getInstance()->get($id);
    $resource = array('datoDemografico' => $datoDemografico);
    $this->_view->render('show.html.twig',$resource);
  }

  public function insertar()
  {
    $this->_view->render('insertar.html.twig');
    //$rta = DatosDemograficosRepository::getInstance()->insert($datos);
  }

  public function home(){
    $this->_view->render('home.html.twig');
  }





}
