<?php
require_once(DIR_NAME.'controleur_admin.php');
class Mod{
  private $controler;
  function __construct(){
    $this->controler = new Controleur_admin;
    $this->controler->init();
  }

}


 ?>
