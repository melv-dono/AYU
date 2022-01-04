<?php
    require_once('./db.php');
    class Modele_lampe {
        public function __construct() {
            
        }

        public function getListeLampesSalle($numSalle){
            $idTypeLampe=1
            $selectRequete = self::$bdd->prepare("SELECT * FROM equipement where idType = ? and numerosalle = ?;");
            $selectRequete->execute(array($idTypeLampe, $numSalle));
            $result=$selectRequete->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }


    }
?>