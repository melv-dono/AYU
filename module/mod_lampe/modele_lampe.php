<?php
    require_once("../../db.php");
    class Modele_lampe extends DB{
        public function __construct() {
            
        }

        /*public function getListeLampesSalle($numSalle){
            $selectRequete = parent::$db->prepare("SELECT * FROM equipement where idType = ? and numerosalle = ?;");
            $selectRequete->execute(array(1, $numSalle));
            $result=$selectRequete->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }*/

        //public function allumer($numSalle, $allumer){
        public function allumer($allumer){
            if($allumer == 1){
                $selectRequete = parent::$db->prepare("UPDATE equipement SET etat=?;");
                //$selectRequete = parent::$db->prepare("UPDATE equipement SET etat=? WHERE numerosalle=?;");
                $selectRequete->execute(array($allumer));
                //$selectRequete->execute(array($allumer,$numSalle));
                echo 'allumé<br>';
            }
            else{
                $selectRequete = parent::$db->prepare("UPDATE equipement SET etat=?;");
                $selectRequete->execute(array($allumer));
                echo 'éteint<br>';
            }
        }

        public function getNumSalle(){
            $selectRequete=parent::$db->prepare("SELECT numerosalle FROM reservation where userid=?;");
            $selectRequete->execute(array($_SESSION[userid]));
            $result=$selectRequete->fechAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>