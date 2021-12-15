<?php
    require_once('./db.php');
    require_once('../../utile/user.php');
    class Modele_reservation {

        public function reserver($salle) {
            $success=0;
            $dateResa = new DateTime();
            $ReqIdResa = $db->prepare('SELECT idReserv FROM salle WHERE id=? and dateReserv = ?;');
            $ReqIdResa->execute(array($salle), array($dateResa));
            $IdResa = $ReqIdResa->fetch(PDO::FETCH_OBJ);
            if (!isset($IdResaesa)) {
                //creation token
                $userId = getUserId();
                //récupérer la durée
                $duree = 2;
                $InsResa = $db->prepare('INSERT INTO reservation VALUES (DEFAULT, ?, ?, ?, ?);');
                $InsResa->execute(array($userId), array($dateResa), array($duree), array($salle));
                $rowCount=$InsResa->rowCount();
                $rowCount<1 ? $success=0 : $success=1;
            }
            return $success;
        }
    }
?>