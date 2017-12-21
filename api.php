<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once 'vendor/autoload.php';
require_once 'app/Config.php';
require_once 'src/entity/Horario.php';
require_once 'src/entity/Turno.php';
require_once 'app/PDORepository.php';
require_once 'src/repository/TurnoRepository.php';
require_once 'src/repository/HorarioRepository.php';

$app = new \Slim\App;

$app->group('/api', function () {

  $this->get('/turnos/{fecha}', function (Request $request, Response $response) {
    $fecha = new DateTime($request->getAttribute('fecha'));
    $fechaAct = new DateTime();
    if($fecha->getTimestamp() < $fechaAct->getTimestamp()){
      return $response->withJson(array("retorno" => "La fecha introducida es invalida."),400);
    }

    $turnos = TurnoRepository::getInstance()->getTurnosLibres($fecha->format('Y-m-d'));

    return $response->withJson(array("retorno" => $turnos),200);
  });

  $this->post('/turnos', function (Request $request, Response $response) {
    $post = $request->getParsedBody();
    $dni = trim($post['dni']);
    $fecha = str_replace('-','/',trim($post['fecha']));
    $horario = trim($post['hora']);

    if( empty($dni) || empty($fecha) || empty($horario)){
      return $response->withJson(array("retorno" => "Parametros invalidos."),400);
    }

    if (strlen($dni) < 7 ) {
      return $response->withJson(array("retorno" => "No parece ser un dni valido."),400);
    }

    $horario = HorarioRepository::getInstance()->getHorarioByNombre($horario);
    if($horario == null){
        return $response->withJson(array("retorno" => "No se indico un horario valido."),400);
    }

    $fecha = DateTime::createFromFormat('d/m/Y', $fecha);
    $fechaAct = new DateTime();
    if($fecha->getTimestamp() < $fechaAct->getTimestamp()){
      return $response->withJson(array("retorno" => "La fecha introducida es invalida."),400);
    }

    $turno = TurnoRepository::getInstance()->getTurno($fecha->format('Y/m/d'),$horario->getId());
    if($turno != null){
      return $response->withJson(array("retorno" => "No hay un turno disponible en ese horario para la fecha indicada."),400);
    }

    $answer = TurnoRepository::getInstance()->setTurno($fecha->format('Y/m/d'),$horario->getId(),$dni);
    if($answer == false){
      return $response->withJson(array("retorno" => "Ha ocurido un error, intente nuevamente."),400);
    }

    return $response->withJson(array("retorno" => "Ha reservado el turno con exito."),200);
  });

});


$app->run();



//  TOKEN TELEGRAM
//  372466954:AAGTR0nnjRHOx2co1J55DSyVfKH0D4qM0-A

?>
