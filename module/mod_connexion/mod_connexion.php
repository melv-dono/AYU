<?php
require_once(DIR_NAME."controleur_connexion.php");
Class Mod{
  private $controleur;
  // Init a new controller
  function __construct(){
    $this->controleur=new Controleur_connexion();
    $this->controleur->init();
  }

}
?>
