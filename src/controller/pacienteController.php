<?php

class pacienteController extends Controller {

  // public function index(){
  //   $pacientes = PacienteRepository::getInstance()->listAll();
  //   $resources = array('pacientes' => $pacientes);
  //   $this->_view->render('index.html.twig',$resources);
  // }

  public function index($pagina=1,$nombreyapellido= '',$documento='',$tipo_documento='todos'){

    $limite = (int) ELEM_PAGINA;
    $desde = $limite * ($pagina-1);
    $resources = ['pagina' => $pagina];
    if(isset($_POST['nombreyapellido'])){
        $nombreyapellido = htmlspecialchars(trim($_POST['nombreyapellido']));
        // var_dump($nombreyapellido);exit;
    }

//    var_dump($tipo_documento);die;
    $resources['pacientes'] = PacienteRepository::getInstance()->listLimitPacientes($limite,$desde,$nombreyapellido,$tipo_documento);
    $total_elem = count(PacienteRepository::getInstance()->listAll($nombreyapellido,$tipo_documento));
    $resources['nombreyapellido'] = $nombreyapellido;

    if(isset($_POST['tipo_documento']) && $_POST['tipo_documento'] != 'todos')
    {
      $tipo_documento = htmlspecialchars(trim($_POST['tipo_documento']));
      //var_dump($tipo_documento);die;
      $resources['pacientes'] = PacienteRepository::getInstance()->listByDocumento($documento,$tipo_documento);
      //echo $tipo_documento;die;
    }

    $resources['tipo_documento'] = $tipo_documento;

    if(isset($_POST['documento']) && !empty($_POST['documento'])){
      $documento = htmlspecialchars(trim($_POST['documento']));
      $resources['documento'] = $documento;
      //var_dump($tipo_documento);die;
      $resources['pacientes'] = PacienteRepository::getInstance()->listByDocumento($documento,$tipo_documento);
      $total_elem = 1;
      //var_dump($resources['pacientes']);exit;
    }

    if((isset($_POST['documento']) && !empty($_POST['documento'])) && $_POST['tipo_documento'] != 'todos')
    {
      $documento = htmlspecialchars(trim($_POST['documento']));
      $resources['documento'] = $documento;
      //var_dump($tipo_documento);die;
      $resources['pacientes'] = PacienteRepository::getInstance()->listByDocumento($documento,$tipo_documento);
      $total_elem = 1;
    }




    $resources['tipo_documentos'] =  DocumentoRepository::getInstance()->listAll();

    $resources['cant_pag'] = ceil ($total_elem / $limite);
    //var_dump($resources);die;
    $this->_view->render('index.html.twig',$resources);
  }

  public function create(){

    $resources['obras_sociales'] = ObraSocialRepository::getInstance()->listAll();
    $resources['tipo_documentos'] = DocumentoRepository::getInstance()->listAll();
    $resources['viviendas'] = ViviendaRepository::getInstance()->listAll();
    $resources['calefaccion'] = CalefaccionRepository::getInstance()->listAll();
    $resources['agua'] = AguaRepository::getInstance()->listAll();





    if(isset($_POST['apellido']) && isset($_POST['nombre']) && isset($_POST['domicilio']) && isset($_POST['fecha_nac']) && isset($_POST['genero']) && isset($_POST['heladera']) && isset($_POST['electricidad'])
    && isset($_POST['mascota']) && isset($_POST['vivienda']) && isset($_POST['calefaccion']) && isset($_POST['agua']) && isset($_POST['obra_social']) && isset($_POST['tipo_documento']) && isset($_POST['documento'])){
      $apellido = strip_tags($_POST['apellido']);
      $nombre = strip_tags($_POST['nombre']);
      $domicilio = strip_tags($_POST['domicilio']);
      $fecha_nac = strip_tags($_POST['fecha_nac']);
      $genero = strip_tags($_POST['genero']);
      $heladera = strip_tags($_POST['heladera']);
      $electricidad = strip_tags($_POST['electricidad']);
      $mascota = strip_tags($_POST['mascota']);
      $vivienda = strip_tags($_POST['vivienda']);
      $calefaccion = strip_tags($_POST['calefaccion']);
      $agua = strip_tags($_POST['agua']);
      $obra_social = strip_tags($_POST['obra_social']);
      $tipo_documento = strip_tags($_POST['tipo_documento']);
      $documento = strip_tags($_POST['documento']);
      $telefono = strip_tags($_POST['telefono']);

      if(!empty($apellido) && !empty($nombre) && !empty($domicilio) && !empty($fecha_nac) && !empty($obra_social)&& !empty($documento) && !empty($telefono)){

        $paciente[0] = strip_tags($_POST['apellido']);
        $paciente[1] = strip_tags($_POST['nombre']);
        $paciente[2] = strip_tags($_POST['domicilio']);
        $paciente[3] = strip_tags($_POST['telefono']);
        $paciente[4] = strip_tags($_POST['fecha_nac']);
        $paciente[5] = strip_tags($_POST['genero']);
        $paciente[6] = strip_tags($_POST['documento']);
        $paciente[7] = strip_tags($_POST['obra_social']);
        $paciente[8] = strip_tags($_POST['tipo_documento']);

        if(PacienteRepository::getInstance()->agregarPaciente($paciente)){
          $datos[0] = strip_tags($_POST['heladera']);
          $datos[1] = strip_tags($_POST['electricidad']);
          $datos[2] = strip_tags($_POST['mascota']);
          $datos[3] = strip_tags($_POST['vivienda']);
          $datos[4] = strip_tags($_POST['calefaccion']);
          $datos[5] = strip_tags($_POST['agua']);
          $datos[6] = PacienteRepository::getInstance()->getByDocumento($paciente[6])->getId();

          if($datosDemograficos = DatosDemograficosRepository::getInstance()->insert($datos)){
            $this->getFlashBag()->setMsj('success',"Paciente registrado correctamente.");
            $this->redirect('paciente/index');
          }else {
            $this->getFlashBag()->setMsj('danger',"Ha ocurrido un error, intente nuevamente.");
          }
        }else {
          $this->getFlashBag()->setMsj('danger',"Ha ocurrido un error, intente nuevamente.");
        }
      }else {
        $this->getFlashBag()->setMsj('danger',"Debe completar todos los campos.");
      }
    }

    $this->_view->render('create.html.twig',$resources);

  }

  public function update($id){
    $paciente = PacienteRepository::getInstance()->get($id);
    if($paciente == null){
      $this->getFlashBag()->setMsj('warning',"El paciente no existe en el sistema.");
      $this->redirect('index/indexAdmin');
    }

    $resources['obras_sociales'] = ObraSocialRepository::getInstance()->listAll();
    $resources['tipo_documentos'] = DocumentoRepository::getInstance()->listAll();
    $resources['viviendas'] = ViviendaRepository::getInstance()->listAll();
    $resources['calefaccion'] = CalefaccionRepository::getInstance()->listAll();
    $resources['agua'] = AguaRepository::getInstance()->listAll();
    $resources['datosDemograficos'] = DatosDemograficosRepository::getInstance()->getByPaciente($id);

    if(isset($_POST['apellido']) && isset($_POST['nombre']) && isset($_POST['domicilio']) && isset($_POST['fecha_nac']) && isset($_POST['genero']) && isset($_POST['obra_social']) && isset($_POST['tipo_documento']) && isset($_POST['documento'])){
      $apellido = strip_tags($_POST['apellido']);
      $nombre = strip_tags($_POST['nombre']);
      $domicilio = strip_tags($_POST['domicilio']);
      $telefono = strip_tags($_POST['telefono']);
      $fecha_nac = strip_tags($_POST['fecha_nac']);
      $genero = strip_tags($_POST['genero']);
      $documento = strip_tags($_POST['documento']);
      $obra_social = strip_tags($_POST['obra_social']);
      $tipo_documento = strip_tags($_POST['tipo_documento']);

      if(!empty($apellido) && !empty($nombre) && !empty($domicilio) && !empty($fecha_nac) && !empty($obra_social)&& !empty($documento) && !empty($telefono)){

        $paciente_aux[0] = $apellido;
        $paciente_aux[1] = $nombre;
        $paciente_aux[2] = $domicilio;
        $paciente_aux[3] = $telefono;
        $paciente_aux[4] = $fecha_nac;
        $paciente_aux[5] = $genero;
        $paciente_aux[6] = $documento;
        $paciente_aux[7] = $obra_social;
        $paciente_aux[8] = $tipo_documento;
        $paciente_aux[9] = $id;

        if(isset($_POST['heladera']) && isset($_POST['electricidad']) && isset($_POST['mascota']) && isset($_POST['tipo_vivienda']) && isset($_POST['tipo_calefaccion']) && isset($_POST['tipo_agua']))
        {
          $heladera = strip_tags($_POST['heladera']);
          $electricidad = strip_tags($_POST['electricidad']);
          $mascota = strip_tags($_POST['mascota']);
          $tipo_vivienda = strip_tags($_POST['tipo_vivienda']);
          $tipo_calefaccion = strip_tags($_POST['tipo_calefaccion']);
          $tipo_agua = strip_tags($_POST['tipo_agua']);
        }

        if($heladera != 'none' && $electricidad != 'none' && $mascota != 'none' && $tipo_vivienda != 'none' && $tipo_calefaccion != 'none' && $tipo_agua != 'none')
        {
          $datos_aux[0] = $heladera;
          $datos_aux[1] = $electricidad;
          $datos_aux[2] = $mascota;
          $datos_aux[3] = $tipo_vivienda;
          $datos_aux[4] = $tipo_calefaccion;
          $datos_aux[5] = $tipo_agua;
          $datos_aux[6] = $resources['datosDemograficos']->getId();
          //var_dump(  $datos_aux[6]);die;
        }else {
          $this->getFlashBag()->setMsj('danger',"Los datos no pueden ser de tipo sin seleccionar.");
          $this->redirect('paciente/index');
        }
        //$aa = PacienteRepository::getInstance()->update($paciente_aux);
        //var_dump($aa);die;
        $qpaciente = PacienteRepository::getInstance()->update($paciente_aux);
        $qdatos = DatosDemograficosRepository::getInstance()->update($datos_aux);

        if(!$qpaciente && $qdatos || $qpaciente && !$qdatos || $qpaciente && $qdatos){
            $this->getFlashBag()->setMsj('success',"Paciente modificado correctamente.");
            $this->redirect('paciente/index');
        }else {
          $this->getFlashBag()->setMsj('danger',"Los datos no han sufrido cambios.");
          $resources['p'] = new Paciente($id, $apellido, $nombre, $domicilio, $telefono, $fecha_nac, $genero,$documento, $obra_social,$tipo_documento);
        }
      }else {
        $this->getFlashBag()->setMsj('danger',"Debe completar todos los campos.");
      }
    } else {
      $resources['p'] = PacienteRepository::getInstance()->get($id);
    }

    $this->_view->render('update.html.twig',$resources);

  }

  public function show($id){
    $paciente = PacienteRepository::getInstance()->get($id);
    $datosDemograficos = DatosDemograficosRepository::getInstance()->getByPaciente($paciente->getId());

    if($paciente == null){
      $this->getFlashBag()->setMsj('warning',"El paciente no existe en el sistema.");
      $this->redirect('index/indexAdmin');
    }
    if($paciente == null)
    {
      $this->getFlashBag()->setMsj('danger','no valido');
      $this->redirect('paciente');
    }
    $resources['paciente'] = PacienteRepository::getInstance()->get($id);
    $resources['datosDemograficos'] = DatosDemograficosRepository::getInstance()->getByPaciente($paciente->getId());
    //var_dump($resources['datosDemograficos']);die;
    $this->_view->render('show.html.twig',$resources);
  }

  public function destroy($id){
    $paciente = PacienteRepository::getInstance()->get($id);
    if($paciente == null){
      $this->getFlashBag()->setMsj('warning',"El paciente no existe en el sistema.");
      $this->redirect('index/indexAdmin');
    }
    $repo = PacienteRepository::getInstance()->setEliminado($id, 1);
    if ($repo) {
      $this->getFlashBag()->setMsj('success',"El paciente ha sido eliminado.");
    } else {
      $this->getFlashBag()->setMsj('danger',"Ha ocurrido un error. El paciente no existe.");
    }
    $this->redirect("paciente/index");
  }


  // public function create()
  // {
  //   $obras_sociales = ObraSocialRepository::getInstance()->listAll();
  //   $tipo_documentos = DocumentoRepository::getInstance()->listAll();
  //   $viviendas = ViviendaRepository::getInstance()->listAll();
  //   $calefaccion = CalefaccionRepository::getInstance()->listAll();
  //   $agua = AguaRepository::getInstance()->listAll();
  //
  //   $resources = array('obras_sociales' => $obras_sociales, 'viviendas' => $viviendas, 'calefaccion' => $calefaccion, 'agua' => $agua, 'tipo_documentos' => $tipo_documentos);
  //   $this->_view->render('agregarpaciente.html.twig',$resources);
  // }


}
