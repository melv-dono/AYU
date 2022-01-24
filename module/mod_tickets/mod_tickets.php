<?php
    require_once(DIR_NAME.'controleur_tickets.php');
    $tickets = new Mod_tickets();
    class Mod{
        private $controleur;

        public function __construct() {
            $this->controleur=new Controleur_tickets();
            $this->controleur->init();
        }
    }
?>