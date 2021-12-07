<?php

class Response{
  //
  private $status_code;
  private $success;
  private $message;
  private $to_cache;
  private $data;
  //Setter Code de retour http
  function setStatusCode($status_code){
    $this->status_code=$status_code;
  }
  //Setter succes de la requette http
  function setSuccess($success){
    $this->success=$success;
  }
  //Setter message d'erreur
  function setMessage($message){
    $this->message=$message;
  }
  //Setter de la mise en cache
  function setToCache($to_cache){
    $this->to_cache=$to_cache;
  }
  //Setter des donnees de retours
  function setData($data){
    $this->data->$data;
  }
}
//Envoi de la response
function sendResponse($status_code,$success,$massage=null,$to_cache=false,$data=null){
  $response=new Response();
  $response->setStatusCode($status_code);
  $response->setSuccess($success);
  $response->setMessage($message);
  $response->setToCache($to_cache);
  $response->setData($data);
  echo(json_encode($response));
  exit();
}

?>
