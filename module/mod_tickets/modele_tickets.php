<?php
    require_once("../../db.php");

    class Modele_tickets extends DB{
        public function __construct() {
            
        }

        function sallesDispo() {
            try {
                $ReqSallesDispo = parent::$db->prepare('SELECT numerosalle FROM salle;');
                $ReqSallesDispo->execute();
                $SalleDispo = $ReqSallesDispo->fetchAll(PDO::FETCH_ASSOC);
            }
            catch(PDOException $err) {
                echo $err;
            }            
            return $SalleDispo;
        }

        function envoyer($objet, $salle, $requete) {
            $success = 0;
        	require_once('../../utile/functions.php');
			$a = new Functions();
			$userId = $a->getDetails();
            try {
                $InsTicket = parent::$db->prepare('INSERT INTO tickets (objet, requete, traite, numerosalle, userid) VALUES (?,?,1,?,?);');
                $InsTicket->execute(array($objet,$requete,$salle, $userId['userid']));
                $success= $InsTicket->rowCount();
            }
            catch(PDOException $err) {
                echo $err;
            }  
            return $success;
        }

        // function equipementDispo($Salle) {
        //     try {
        //         $ReqEquipement = parent::$db->prepare('SELECT nom FROM equipement WHERE numerosalle = ?;');
        //         $ReqEquipement->execute(array($Salle));
        //         $Equipement = $ReqEquipement->fetchAll(PDO::FETCH_ASSOC);
        //     }
        //     catch(PDOException $err) {
        //         echo $err;
        //     }
        //     return $Equipement;
        // }
        
    }
?>