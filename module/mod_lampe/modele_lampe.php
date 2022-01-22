<?php
    require_once("../../db.php");
    class Modele_lampe extends DB{
        public function __construct() {
            
        }

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
                //$selectRequete = parent::$db->prepare("UPDATE equipement SET etat=? WHERE numerosalle=?;");
                $selectRequete->execute(array($allumer));
                //$selectRequete->execute(array($allumer,$numSalle));
                echo 'éteint<br>';
            }
        }

        /*public function getEtat(){
            $selectRequete = parent::$db->prepare("SELECT etat FROM equipement WHERE numerosalle=?;");
            $selectRequete->execute(array("B112"));
            $result=$selectRequete->fechAll(PDO::FETCH_ASSOC);
            echo $result;
        }*/
        
        //public function setLuminosite($lum,$numSalle){
        public function setLuminosite($lum){
            $selectRequete = parent::$db->prepare("UPDATE caracteristique SET valeur=? WHERE idcaracteristique=?;");
                //$selectRequete = parent::$db->prepare("UPDATE caracteristique SET valeur=? WHERE idcaracteristique=? AND numerosalle=?;");
                $selectRequete->execute(array($lum,"1"));
                //$selectRequete->execute(array($lum,"1",$numSalle));
        }

        public function getNumSalle(){
            $selectRequete=parent::$db->prepare("SELECT numerosalle FROM reservation where userid=?;");
            $selectRequete->execute(array($_SESSION[userid]));
            $result=$selectRequete->fechAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>