<?php
    require_once 'controleur_reservation';

    class Mod_reservation {

        private $action;
        private $salle;
        private $debut;
        private $fin;
        private $ctrl;

        // Récuperer la salle courante
        // Récupérer la date sélectionner
        // Récupérer la fin et le début sélectionner

        function __construct() {
            $this->ctrl = new Controleur_reservation ();
        }

        function agir(){
            $this->crtl->init();
        }
    }
?>