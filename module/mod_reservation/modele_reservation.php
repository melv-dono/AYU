<?php
    require_once('./db.php');
    require_once('../../utile/user.php');
    class Modele_reservation {

        public function reserver($salle, $debut, $fin) {
            // Attention modification BD
            $success=0;
            $dureeMin = new DateInterval('PT30M');
            isset($debut) ? $debutResa = new DateTime() : $debutResa = $debut;
            isset($fin) || ($fin->diff($debutResa)) < 30 ? $finResa = $debutResa->add($dureeMin) : $finResa =  $fin;  

            $ReqIdResa = $db->prepare('SELECT idReserv FROM reservation WHERE numerosalle=? and debutreserv = ?;');
            $ReqIdResa->execute(array($salle), array($debutResa));
            $IdResa = $ReqIdResa->fetch(PDO::FETCH_OBJ);

            if (!isset($IdResaesa)) {
                //TO DO : Vérification du userId avec le token avant la requête
                $userId = getUserId();
                $InsResa = $db->prepare('INSERT INTO reservation VALUES (DEFAULT, ?, ?, ?, ?);');
                $InsResa->execute(array($userId), array($debutResa), array($finResa), array($salle));
                $rowCount=$InsResa->rowCount();
                $rowCount<1 ? $success=0 : $success=1;
            }
            return $success;
        }
    }
?>