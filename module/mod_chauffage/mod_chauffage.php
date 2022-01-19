<?php
    require_once('controleur_chauffage.php');
    $chauffage = new Mod_chauffage();
    class Mod_chauffage {
        private $controleur;
        private $action;
        public function __construct() {
            $this->controleur=new Controleur_chauffage();
            if(!isset($_GET['action'])){
                $this->action='index';
            }
            else{
                $this->action=$_GET['action'];
            }
            switch($this->action){
                case 'index':
                    $this->controleur->mettreMenu();
                
            }
        }
    }
    //http://localhost/~mnguyen/AYU/module/mod_chauffage/mod_chauffage.php?module=chauffage
?>