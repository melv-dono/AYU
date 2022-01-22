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
    isset($_GET['action']) ? $this->action=$_GET['action'] : $this->action="login";
  }
  // Init new componnent
  function init(){
    switch ($this->action) {
      case 'login':
          $this->vue->login_form();
        break;
        case 'signin':
          $this->vue->signin_form();
        break;
      case 'loginSubmit':
          $this->login();
        break;
      case 'signinSubmit':
          $this->signin();
        break;
      case 'refresh':
          $this->refresh();
        break;
      case 'logout':
          $this->logout();
        break;
      default:
        echo('404 not found');
        break;
    }
  }

  function login(){
    !array_key_exists("username",$_POST) ? exit : $username=htmlspecialchars($_POST['username']);
    !array_key_exists("password",$_POST) ? exit : $password=htmlspecialchars($_POST['password']);
    $this->modele->insertSession($username,$password);
    header("Location:index.php");
  }
  function signin(){
    !array_key_exists("username",$_POST) ? exit : $username=htmlspecialchars($_POST['username']);
    !array_key_exists("password",$_POST) ? exit : $password=htmlspecialchars($_POST['password']);
    !array_key_exists("firstname",$_POST) ? exit : $firstname=htmlspecialchars($_POST['firstname']);
    !array_key_exists("lastname",$_POST) ? exit : $lastname=htmlspecialchars($_POST['lastname']);
    !array_key_exists("role",$_POST) ? $role="user" : $role=htmlspecialchars($_POST['role']);
    $this->modele->signin($username, $password,$firstname,$lastname,$role);
    header("Location:index.php");
  }
  function refresh(){
    if(!isset($_SESSION["access_token"]))
        header("Location:index.php");
    $this->modele->refresh();
    header("Location:index.php");
  }
  function logout(){
    $this->modele->logout();
  }

}
