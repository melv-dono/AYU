<?php
require_once(DIR_NAME."modele_admin.php");
require_once(DIR_NAME."vue_admin.php");


class Controleur_admin{
  private $modele;
  private $vue;
  private $action;

  function __construct(){
    $this->modele=new Modele_admin;
    $this->vue=new Vue_admin;
    $this->action=isset($_GET["action"])?$_GET["action"]:"dash";
  }

  function init(){
    require_once(FUNCTIONS);
    $function->is_admin()!==1?header('location:index.php'):false;
    switch($this->action){
      case "dash ":
        $this->showDash();
        break;
      case "addSalle":
        $this->addSalle();
        break;
      default:
        $this->showDash();
        break;
    }
  }

  function addSalle(){
    $rawData=file_get_contents('php://input');
    if($data=json_decode($rawData)){
      if($this->modele->addSalle($data->numeroSalle,$data->capacite,$data->nbPostes)>0){
        error_log("ici");
        header("ok",true,201);
      }
      else{
        error_log("la");
        header("error",false,500);
      }
    }
    else {
      header("error",false,500);
    }
  }
  function showDash(){
    $users=$this->modele->listAllUsers();
    $salles=$this->modele->listSalles();
    $tickets=$this->modele->listAllTickets();
    $this->vue->show($users,$salles,$tickets);
  }
}

 ?>
