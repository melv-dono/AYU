<?php
    require_once(DIR_NAME.'controleur_reservation.php');

  class Mod {

        private $action;
        private $salle;
        private $debut;
        private $fin;
        private $ctrl;

        // Récuperer la salle courante
        // Récupérer la date sélectionner
        // Récupérer la fin et le début sélectionner

        function __construct() {
            $this->ctrl = new Controleur_reservation() ;
            $this->ctrl ->init();
        }

    }
?>
