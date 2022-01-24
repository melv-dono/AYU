<?php
    require_once("db.php");
    class Modele_lampe extends DB{
        public function __construct() {

        }

        public function allumer($allumer){
            $selectRequete = parent::$db->prepare("SELECT * FROM reservation WHERE userid=? AND TIMEDIFF(dateD,NOW())>'-01:00:00' and TIMEDIFF(dateD,NOW())<'00:00:00';");
            $selectRequete->execute(array($userid));
            $rowcount=$selectRequete->rowCount();
            if($rowcount=1){
                $numSalle=getNumSalle();
                if($allumer == 1){
                    //$selectRequete = parent::$db->prepare("UPDATE equipement SET etat=?;");
                    $selectRequete = parent::$db->prepare("UPDATE equipement SET etat=? WHERE numerosalle=?;");
                    //$selectRequete->execute(array($allumer));
                    $selectRequete->execute(array($allumer,$numSalle));
                    echo 'allumé<br>';
                }
                else{
                    //$selectRequete = parent::$db->prepare("UPDATE equipement SET etat=?;");
                    $selectRequete = parent::$db->prepare("UPDATE equipement SET etat=? WHERE numerosalle=?;");
                    //$selectRequete->execute(array($allumer));
                    $selectRequete->execute(array($allumer,$numSalle));
                    echo 'éteint<br>';
                }
            }
            else{
                echo 'erreur, vous avez pas de réservation';
            }
        }

        public function setLuminosite($lum){
            $selectRequete = parent::$db->prepare("SELECT * FROM reservation WHERE userid=? AND TIMEDIFF(dateD,NOW())>'-01:00:00' and TIMEDIFF(dateD,NOW())<'00:00:00';");
            $selectRequete->execute(array($userid));
            $rowcount=$selectRequete->rowCount();
            if($rowcount=1){
                $numSalle=getNumSalle();
                //$selectRequete = parent::$db->prepare("UPDATE caracteristique SET valeur=? WHERE idcaracteristique=?;");
                $selectRequete = parent::$db->prepare("UPDATE caracteristique SET valeur=? WHERE idcaracteristique=? AND numerosalle=?;");
                //$selectRequete->execute(array($lum,"1"));
                $selectRequete->execute(array($lum,"1",$numSalle));
            }
            else{
                echo 'erreur, vous avez pas de réservation';
            }
            
        }

        public function getNumSalle(){
            $selectRequete=parent::$db->prepare("SELECT numerosalle FROM reservation where userid=? AND TIMEDIFF(dateD,NOW())>'-01:00:00' and TIMEDIFF(dateD,NOW())<'00:00:00';");
            $selectRequete->execute(array($_SESSION[userid]));
            $result=$selectRequete->fechAll(PDO::FETCH_ASSOC)[numerosalle];
            return $result;
        }
    }
?>
