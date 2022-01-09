<?php
    class Mod_lampe {
        private $controleur;
        private $action;
        public function __construct() {
            $this->controleur=new Controleur_lampe();
            if(!isset($_GET['action'])){
                $this->action='index';
            }
            else{
                $this->action=$_GET['action'];
            }
            switch($this->action){
                case 'allumer':
                    $this->controleur->allumer();
                    //ajouter en paramètre le num de salle de allumer()
                    break;
                case 'eteindre':
                    $this->controleur->eteindre();
                    break;
            }
        }

        function agir(){

        }
    }
?>