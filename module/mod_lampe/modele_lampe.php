<?php
    require_once('./db.php');
    class Modele_lampe {
        public function __construct() {
            
        }

        public function getListeLampesSalle($numSalle){
            $selectRequete = self::$bdd->prepare("SELECT * FROM equipement where idType = ? and numerosalle = ?;");
            $selectRequete->execute(array(1, $numSalle));
            $result=$selectRequete->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function allumer($numSalle, $allumer){
            if($allumer == 1){
                $selectRequete = self::$bdd->prepare("UPDATE equipement SET etat=? where numerosalle = ?;");
                $selectRequete->execute(array($allumer, $numSalle));
                echo 'allumé';
            }
            else{
                $selectRequete = self::$bdd->prepare("UPDATE equipement SET etat=? where numerosalle = ?;");
                $selectRequete->execute(array($allumer, $numSalle));
                echo 'éteint';
            }
        }

        public function getNumSalle(){
            $selectRequete=self::$bdd->prepare("SELECT numerosalle FROM reservation where userid=?;");
            $selectRequete->execute(array($_SESSION[userid]));
            $result=$selectRequete->fechAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>