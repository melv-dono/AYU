<?php
require_once(DIR_NAME."controleur_accueil.php");
    class Mod {
      private $controleur;
        public function __construct() {
          $this->controleur=new Controleur_accueil();
          require_once("utile/functions.php");
          $function->verifConnexion()===-1?header('location:index.php?module=connexion&action=login'):false;
          $this->controleur->init();
        }

    }
?>
