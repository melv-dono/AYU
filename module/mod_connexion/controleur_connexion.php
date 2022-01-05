<?php
require_once("./module/mod_connexion/modele_connexion.php");
require_once("./module/mod_connexion/vue_connexion.php");

Class Controleur_connexion{
  private $modele;
  private $vue;
  private $action;

  function __construct(){
    $this->modele=new Modele_connexion();
    $this->vue=new Vue_connexion();
    isset($_GET['action']) ? $this->action=$_GET['action'] : false;
  }
  // Init new componnent
  function init(){
    if(!isset($this->action))
      //$this->vue->login_form();
      $this->vue->signin_form();
    else if($this->action=="login")
      $this->login();
    else if($this->action=="signin")
      $this->signin();
    else
      echo('404 not found');
  }

  function login(){
    !array_key_exists("username",$_POST) ? exit : false;
    !array_key_exists("password",$_POST) ? exit : false;
    $this->modele->insertSession($_POST['username'],$_POST['password']);
  }
  function signin(){
    !array_key_exists("username",$_POST) ? exit : $username=$_POST['username'];
    !array_key_exists("password",$_POST) ? exit : $password=$_POST['password'];
    !array_key_exists("firstname",$_POST) ? exit : $firstname=$_POST['firstname'];
    !array_key_exists("lastname",$_POST) ? exit : $lastname=$_POST['lastname'];
    !array_key_exists("email",$_POST) ? exit : $email=$_POST['email'];
    $this->modele->signin($);
  }


  function array_keys_exists($keyArray , $array){
    $exist=false;
    foreach ($keyArray as $key => $value) {
      $exist$
    }
  }
}
