<?php
    class Modele_reservation {
        public function __construct() {
            
        }

        public function reserver($salle) {
            $dateResa = new DateTime();
            $selectSalle = parent::$bdd->prepare('SELECT * FROM salle WHERE id=?');
            $selectSalle->execute(array($salle), array($dateResa));
            $description = $selectDetails->fetch(PDO::FETCH_OBJ);
            return $description;
        }
    }
?>