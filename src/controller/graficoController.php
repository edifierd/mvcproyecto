<?php


class graficoController extends Controller {

  public function index(){}

  public function show($paciente_id){
    $resource['paciente'] = PacienteRepository::getInstance()->get($paciente_id);
    if($resource['paciente'] == null){
      $this->getFlashBag()->setMsj('warning',"El paciente no existe en el sistema.");
      $this->redirect('index/indexAdmin');
    }

    // /var_dump(ControlSaludRepository::getInstance()->getByPacienteId($paciente_id));die;

    $this->_view->render('show.html.twig',$resource);
  }




  //CONSULTAS AJAX

  public function getpaciente(){
    $paciente_id = $_POST['paciente_id'];
    echo json_encode(PacienteRepository::getInstance()->get($paciente_id));die;
  }

  public function getcontrolsalud(){
    $paciente_id = $_POST['paciente_id'];
    echo json_encode(ControlSaludRepository::getInstance()->getByPacienteId($paciente_id));die;
  }



}
