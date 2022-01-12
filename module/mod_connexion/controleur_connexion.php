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
    $this->vue->login_form();
    //   $this->vue->signin_form();
    else if($this->action=="login")
      $this->login();
    else if($this->action=="signin")
      $this->signin();
    else
      echo('404 not found');
  }

  function login(){
    print_r($_POST);
    !array_key_exists("username",$_POST) ? exit : false;
    !array_key_exists("password",$_POST) ? exit : false;
    $this->modele->insertSession($_POST['username'],$_POST['password']);
  }
  function signin(){
    !array_key_exists("username",$_POST) ? exit : $username=$_POST['username'];
    !array_key_exists("password",$_POST) ? exit : $password=$_POST['password'];
    !array_key_exists("firstname",$_POST) ? exit : $firstname=$_POST['firstname'];
    !array_key_exists("lastname",$_POST) ? exit : $lastname=$_POST['lastname'];
    !array_key_exists("role",$_POST) ? $role="user" : $role=$_POST['role'];
    $this->modele->signin($username, $password,$firstname,$lastname,$role);
  }

}
