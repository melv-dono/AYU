<?php
    require_once(DIR_NAME.'controleur_tickets.php');
    class Mod{
        private $controleur;

        public function __construct() {
            $this->controleur=new Controleur_tickets();
            $this->controleur->init();
        }
    }
?>