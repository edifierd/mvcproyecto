<?php


class telegramController extends Controller {

  public function index(){}

    public function hook(){

      $token  = 'bot372466954:AAGTR0nnjRHOx2co1J55DSyVfKH0D4qM0-A';
      $bot_username = 'grupo36Bot';


      $telegram = file_get_contents('php://input');
      $telegram = json_decode($telegram, TRUE);

      $chatid = $telegram['message']['from']['id'];
      $mensaje = explode(' ',$telegram['message']['text']);

      $metodo = array_shift($mensaje);

      switch ($metodo) {
        case '/turnos':
          $fecha = array_shift($mensaje);
          $answer = json_decode(CurlRequest::getInstance()->sendGet(BASE_URL_INC.'api/turnos/'.str_replace('/','-',$fecha)),true);
          $turnos = $answer['retorno'];
          if(CurlRequest::getInstance()->isSuccess()){
            $respuesta = "Los horarios disponibles para el ".str_replace('-','/',$fecha)." son: \n \n";
            $cont = 0;
            foreach ($turnos as $turno) {
              $cont +=1;
              $respuesta .= $turno['nombre'] . " | ";
              if($cont ==  5){
                $respuesta .= "\n";
                $cont = 0;
              }
            }
          } else {
            $respuesta = $turnos;
          }
          $rta = $this->sendMessage($chatid,$respuesta,$token);
          break;
        case '/reservar':
          $params['dni'] = array_shift($mensaje);
          $params['fecha'] = array_shift($mensaje);
          $params['hora'] = array_shift($mensaje);
          $reserva = json_decode(CurlRequest::getInstance()->sendPost(BASE_URL_INC.'api/turnos',$params),true);
          if($reserva == null){
            $reserva['retorno'] = "No hay un turno disponible en ese horario para la fecha indicada.";
          }
          $rta = $this->sendMessage($chatid,$reserva['retorno'],$token);
          break;
        default:
          $respuesta = "¿No he entendio el mensaje? Usted quizas quiso decir: \n";
          $respuesta .= " - /turnos {fecha} \n";
          $respuesta .= " - /reservar {dni} {fecha} {hora} \n";
          $this->sendMessage($chatid,$respuesta,$token);
          break;
      }

    }

    private function sendMessage($chatid, $text, $token){
      $url = 'https://api.telegram.org/'.$token.'/sendMessage?chat_id='.$chatid.'&text='.urlencode($text).'&parse_mode=Markdown';
      $ch = curl_init();
      $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        // esto es para evitar que NO valide el certificado de la URL
        // de lo contrario hay que incorporar la CA como confiable
        CURLOPT_SSL_VERIFYPEER => false,
      );
      curl_setopt_array($ch, $optArray);
      $result = curl_exec($ch);
      if($result === FALSE) {
        return curl_error($ch);
      }
      curl_close($ch);
      return true;
    }


  }


  //EJEMPLO RESPUESTA:

  /*
  {
  "update_id":779070303,
  "message":{
  "message_id":17,
  "from":{
  "id":475243683,
  "is_bot":false,
  "first_name":"Federico",
  "last_name":"Tubaro",
  "language_code":"es"
},
"chat":{
"id":475243683,
"first_name":
"Federico",
"last_name":"Tubaro",
"type":"private"
},
"date":1510167066,
"text":"fede"
}
}
*/
