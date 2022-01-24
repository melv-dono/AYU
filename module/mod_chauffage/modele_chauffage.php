<?php
    require_once("../../db.php");
    require_once("../../utile/functions.php");
    $function = new Functions();
    $userid=$function->getDetails()['userid'];

    class Modele_chauffage extends DB{
        public function __construct() {
            
        }

        public function setTemperature($tempe){
            $selectRequete = parent::$db->prepare("SELECT * FROM reservation WHERE userid=? AND TIMEDIFF(heure,NOW())>'-01:00:00' and TIMEDIFF(heure,NOW())<'00:00:00';");
            $selectRequete->execute(array($userid));
            $rowcount=$selectRequete->rowCount();
            if($rowcount=1){
                $numSalle=getNumSalle();
                $selectRequete = parent::$db->prepare("UPDATE caracteristique SET valeur=? WHERE idcaracteristique=? AND numerosalle=?;");
                $selectRequete->execute(array($tempe,"3",$numSalle));
            }
            else{
                echo "erreur";
            }
        }

        public function getNumSalle(){
            $selectRequete=parent::$db->prepare("SELECT numerosalle FROM reservation where userid=? AND TIMEDIFF(heure,NOW())>'-01:00:00' and TIMEDIFF(heure,NOW())<'00:00:00';");
            $selectRequete->execute(array($userid));
            $result=$selectRequete->fechAll(PDO::FETCH_ASSOC)[numerosalle];
            return $result;
        }
        
    }
?>