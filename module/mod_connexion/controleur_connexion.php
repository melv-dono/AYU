<?php
require_once("./module/mod_connexion/modele_connexion.php");
require_once("./module/mod_connexion/vue_connexion.php");
Class Controleur_connexion{
  private $modele;
  private $vue;
  private $action;
  //
  function __construct(){
    $this->modele=new Modele_connexion();
    $this->vue=new Vue_connexion();
    isset($_GET['action']) ? $this->action=$_GET['action'] : false;
  }
  //
  function init(){$this->vue->affiche_form();}
}
