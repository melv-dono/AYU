<?php
require_once("module/mod_accueil/controleur_accueil.php");
    class Mod_accueil {
      private $controleur;
        public function __construct() {
          $this->controleur=new Controleur_accueil();
        }
        function show(){
          $this->controleur->init();
        }

    }
?>
