<?php

class CurlRequest {

  private static $instance;
  private $curl;

  public static function getInstance() {

    if(self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;

  }

  private function __construct() {
  }

  private function configureNewSession($url, $params, $method, $headers) {
    // Se cierra la sesión CURL liberando sus recursos y se inicia otra para la nueva petición
    if(!empty($this->curl)){
      curl_close($this->curl);
    }

    $this->curl = curl_init($url);

    //Se establece que curl_excec devuelva el resultado del requerimiento en caso de éxito
    curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    //Se establece el método http que queremos utilizar para la petición
    curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);
    //Se envían los datos recibidos como parámetro
    curl_setopt($this->curl, CURLOPT_POSTFIELDS,http_build_query($params));
    //Opciones adicionales

    curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 0);

    //Se agregan los headers recibidos como parámetro
    curl_setopt_array($this->curl, $headers);
  }

  public function sendPost($url, $params = null, $headers = array()) {
    $this->configureNewSession($url, $params, "POST", $headers);
    //Se obtiene la respuesta
    $response = curl_exec($this->curl);
    return $response;
  }

  public function sendGet($url, $params = null, $headers = array()) {
    $this->configureNewSession($url, $params, "GET", $headers);
    //Se obtiene la respuesta
    $response = curl_exec($this->curl);
    return $response;
  }

  public function isSuccess() {
    return curl_getinfo($this->curl, CURLINFO_HTTP_CODE) == 200;
  }

  public function getHttpCode() {
    return curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
  }

  public static function getTipo($url){
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
    ));
    $answer = curl_exec($curl);
    if ($answer){
      return json_decode($answer);
    }
    else {
      return false;
    }

    curl_close($curl);

  }


}

?>
