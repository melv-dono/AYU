<?php
    require_once("db.php");

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

        function suppTicket($idticket) {
            try {
                require_once(FUNCTIONS);
                $function = new Functions();
                $userId = $function->getDetails()['userid'];

                if($function->is_admin()>0){
                    $DelExiRes=parent::$db->prepare("DELETE FROM tickets WHERE idticket = ? ");
                    $DelTicket->execute(array($idticket));
                }
                else {
                    $DelTicket = parent::$db->prepare('DELETE FROM tickets WHERE idticket = ? AND userid = ?;');
                    $DelTicket->execute(array($idticket, $userId));
                }
                return $DelTicket->rowCount();
            }
            catch(PDOException $err) {
                echo $err;
            }    
        }

        function envoyer($objet, $salle, $requete) {
            $success = 0;
        	require_once('utile/functions.php');
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
    }
?>