<?php


class controlsaludController extends Controller {


  public function index()
  {
    $controles = ControlSaludRepository::getInstance()->listAll();
    $resources = array('controles' => $controles);
    if(isset($_POST['nombreyapellido'])){
        $nombreyapellido = htmlspecialchars(trim($_POST['nombreyapellido']));
        // var_dump($nombreyapellido);exit;
    }
    $this->_view->render('index.html.twig',$resources);
  }


  public function create($idP)
  {
    //var_dump(App::getInstance()->current_user());die;

    $paciente = PacienteRepository::getInstance()->get($idP);
    $resources['paciente'] =  $paciente;
    $this->_view->render('create.html.twig',$resources);
  }

  public function insertarControlDeSalud($idP)
  {
    if(isset($_POST['fecha']) && isset($_POST['peso']) && isset($_POST['ex_fisico_normal']) && isset($_POST['observaciones_generales']) && isset($_POST['vacunas_completas']) && isset($_POST['maduracion_acorde'])
        && isset($_POST['ex_fisico_normal']) && isset($_POST['ex_fisico_observaciones']) && isset($_POST['maduracion_observaciones']))
      {
        $paciente_id = $idP;
        $usuario_id = App::getInstance()->current_user()->getId();


        $maduracion_observaciones = strip_tags($_POST['maduracion_observaciones']);
        $fecha = strip_tags($_POST['fecha']);
        $peso = strip_tags($_POST['peso']);
        $vacunas_completas = strip_tags($_POST['vacunas_completas']);
        $maduracion_acorde = strip_tags($_POST['maduracion_acorde']);
        $ex_fisico_normal = strip_tags($_POST['ex_fisico_normal']);
        $ex_fisico_observaciones = strip_tags($_POST['ex_fisico_observaciones']);
        $pc = strip_tags($_POST['pc']);
        $ppc = strip_tags($_POST['ppc']);
        $talla = strip_tags($_POST['talla']);
        $alimentacion = strip_tags($_POST['alimentacion']);
        $observaciones_generales = strip_tags($_POST['observaciones_generales']);


        if(!empty($peso) && !empty($observaciones_generales) && !empty($fecha) && !empty($ex_fisico_observaciones))
        {
          $datos[0] = $fecha;
          $datos[1] = $peso;
          $datos[2] = $vacunas_completas;
          $datos[3] = $maduracion_acorde;
          $datos[4] = $maduracion_observaciones;
          $datos[5] = $ex_fisico_normal;
          $datos[6] = $ex_fisico_observaciones;
          $datos[7] = $pc;
          $datos[8] = $ppc;
          $datos[9] = $talla;
          $datos[10] = $alimentacion;
          $datos[11] = $observaciones_generales;
          $datos[12] = $paciente_id;
          $datos[13] = $usuario_id;
          //var_dump($datos[0]);die;
          if($rta = ControlSaludRepository::getInstance()->insert($datos))
          {
            $this->getFlashBag()->setMsj('success','Control de salud añadido correctamente.');
            $this->redirect('controlSalud/show/'.$idP);
          }else {
            $this->getFlashBag()->setMsj('danger','Control de salud No añadido.');
            $this->redirect('controlSalud/update');
          }
        }else {
          //var_dump($ex_fisico_normal);die;
        }
      }else {
        $this->getFlashBag()->setMsj('danger','Hay campos que son obligatorios.');
        $this->redirect('controlSalud/index');
      }
  }


  public function show($id)
  {
    $controles = ControlSaludRepository::getInstance()->getByPacienteId($id);
    $paciente = PacienteRepository::getInstance()->get($id);
    $resources = array('controles' => $controles);
    $resources['paciente'] = $paciente;
    //var_dump($resources);
    $this->_view->render('listado.html.twig',$resources);
  }

  public function showControl($id)
  {
    $control = ControlSaludRepository::getInstance()->get($id);
    $edad = $control->getPaciente()->getEdad();
    $resources['control'] = $control;
    $resources['edad'] = $edad;
      //var_dump($resources);die;
    $this->_view->render('show.html.twig',$resources);
  }

  public function update($id){

    $controles = ControlSaludRepository::getInstance()->get($id);
    //var_dump($controles);die;
    $resources = array('controles' => $controles);

    if($controles == null)
    {
      $this->getFlashBag()->setMsj('danger','No existe controles de salud para dicho paciente.');
      $this->redirect('paciente/index/');
    }
      //var_dump($_POST['maduracion_observaciones']);die;
    if(isset($_POST['fecha']) && isset($_POST['peso']) && isset($_POST['ex_fisico_normal']) && isset($_POST['observaciones_generales']) && isset($_POST['vacunas_completas']) && isset($_POST['maduracion_acorde'])
        && isset($_POST['ex_fisico_normal']) && isset($_POST['ex_fisico_observaciones']) && isset($_POST['maduracion_observaciones']))
      {
        //var_dump($controles->getPaciente()->getId());die;
        $paciente_id = $controles->getPaciente()->getId();//aca falta todo el update
        //var_dump($paciente_id);die;
        $usuario_id = App::getInstance()->current_user()->getId();


        $maduracion_observaciones = strip_tags($_POST['maduracion_observaciones']);
        $fecha = strip_tags($_POST['fecha']);
        $peso = strip_tags($_POST['peso']);
        $vacunas_completas = strip_tags($_POST['vacunas_completas']);
        $maduracion_acorde = strip_tags($_POST['maduracion_acorde']);
        $ex_fisico_normal = strip_tags($_POST['ex_fisico_normal']);
        $ex_fisico_observaciones = strip_tags($_POST['ex_fisico_observaciones']);
        $pc = strip_tags($_POST['pc']);
        $ppc = strip_tags($_POST['ppc']);
        $talla = strip_tags($_POST['talla']);
        $alimentacion = strip_tags($_POST['alimentacion']);
        $observaciones_generales = strip_tags($_POST['observaciones_generales']);


        if(!empty($peso) && !empty($alimentacion) && !empty($observaciones_generales) && !empty($pc) && !empty($ppc) && !empty($talla))
        {
          $datos[0] = $fecha;
          $datos[1] = $peso;
          $datos[2] = $vacunas_completas;
          $datos[3] = $maduracion_acorde;
          $datos[4] = $maduracion_observaciones;
          $datos[5] = $ex_fisico_normal;
          $datos[6] = $ex_fisico_observaciones;
          $datos[7] = $pc;
          $datos[8] = $ppc;
          $datos[9] = $talla;
          $datos[10] = $alimentacion;
          $datos[11] = $observaciones_generales;
          $datos[12] = $id;

          if($qcontroles = ControlSaludRepository::getInstance()->update($datos))
          {
            $this->getFlashBag()->setMsj('success','Los datos han sido cambiados correctamente.');
            $this->redirect('controlSalud/show/'.$paciente_id);
          }

        }
        else {
          $this->getFlashBag()->setMsj('danger','Los campos edad,peso,alimentacion,obs. grales, pc, ppc, talla son obligatorios.');
          $this->redirect('controlSalud/update');
        }
      }else {
        //echo "string";die;
      }
      $this->_view->render('update.html.twig',$resources);

  }

  public function destroy($id){
    $control = ControlSaludRepository::getInstance()->get($id);
    if($control != null)
    {
      $paciente_id = $control->getPaciente()->getId();
        if($rta = ControlSaludRepository::getInstance()->setEliminado($id,1))
        {
          $this->getFlashBag()->setMsj('sussecc','Control eliminado exitosamente');
          $this->redirect('controlSalud/show/'.$paciente_id);
        }
    }
  }





}
