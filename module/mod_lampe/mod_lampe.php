<?php
    require_once('controleur_lampe.php');
    $lampe = new Mod_lampe();
    class Mod_lampe {
        private $controleur;
        private $action;
        private $etat;
        public function __construct() {
            $this->controleur=new Controleur_lampe();
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
                case 'allumer':
                    $this->controleur->allumer();
                    break;
                case 'eteindre':
                    $this->controleur->eteindre();
                    break;
            }
        }
    }
    //http://localhost/~mnguyen/AYU/module/mod_lampe/mod_lampe.php?module=lampe
?>