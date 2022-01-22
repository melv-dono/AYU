<?php
    require_once('controleur_tickets.php');
    $tickets = new Mod_tickets();
    class Mod_tickets {
        private $controleur;
        private $action;
        private $etat;
        public function __construct() {
            $this->controleur=new Controleur_tickets();
            if(!isset($_GET['action'])){
                $this->action='index';
            }
            else{
                $this->action=$_GET['action'];
            }
            switch($this->action){
                case 'index':
                    $this->controleur->mettreMenu();
                    break;
            }
        }
    }
    //http://localhost/~mnguyen/AYU/module/mod_tickets/mod_tickets.php
?>