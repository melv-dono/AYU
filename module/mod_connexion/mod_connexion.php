<?php
require_once("./module/mod_connexion/controleur_connexion.php");
Class Mod_connexion{
  private $controleur;
  // Init a new controller
  function __construct(){
    $this->controleur=new Controleur_connexion();
  }

  function display(){
    $this->controleur->init();
  }
}
?>
