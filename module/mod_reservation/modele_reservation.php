<?php
    require_once('./db.php');
    require_once('../../utile/user.php');
    class Modele_reservation {

        function __construct() {
            // Attention cette partie du code est mtn dans le conterolleur
            // Donc modifier le reste de la classe plus tard
            $this->salle = htmlspecialchars($_GET['salle']);
            $this->debut = htmlspecialchars($_GET['debut']);
            $this->duree = htmlspecialchars($_GET['duree']);
            $this->date = htmlspecialchars($_GET['date']);
            $this->fin = htmlspecialchars($_GET['fin']);
        }

        public function reserver($salle, $debut, $fin) {
            // Attention modification BD
            $success=0;
            $dureeMin = new DateInterval('PT30M');
            isset($this->debut) ? $debutResa = new DateTime() : $debutResa = $this->debut;
            isset($this->fin) || ($this->fin->diff($debutResa)) < 30 ? $finResa = $debutResa->add($dureeMin) : $finResa =  $this->fin;  

            $ReqIdResa = $db->prepare('SELECT idReserv FROM reservation WHERE numerosalle=? and debutreserv = ?;');
            $ReqIdResa->execute(array($this->salle), array($debutResa));
            $IdResa = $ReqIdResa->fetch(PDO::FETCH_OBJ);

            if (!isset($IdResaesa)) {
                //TO DO : Vérification du userId avec le token avant la requête
                $userId = getUserId();
                $InsResa = $db->prepare('INSERT INTO reservation VALUES (DEFAULT, ?, ?, ?, ?);');
                $InsResa->execute(array($userId), array($debutResa), array($finResa), array($this->salle));
                $rowCount=$InsResa->rowCount();
                $rowCount<1 ? $success=0 : $success=1;
            }
            return $success;
        }

        function listSalleDispo() {
            // Verifier que la requète et bonne et que le execute avec une liste fonction bien
            // Voir dans quelle mesure il est possible de cast un FETCH_OBJ en array()
            try {
                $ReqListSalleReservee = $db->prepare('SELECT numerosalle FROM reservation;');
                $ReqListSalleReservee->execute();
                $ListSalleReservee = $ReqIdResa->fetch(PDO::FETCH_ASSOC);

                if ($ReqListSalleReservee->rowCount() > 0) {
                    $ReqListSalleDispo = $db->preprare('SELECT numerosalle FROM salle WHERE numerosalle NOT IN (?);');
                    $ReqListSalleDispo->execute($ListSalleReservee);
                    $ListSalleDispo = $ReqListSalleDispo->fetch(PDO::FETCH_ASSOC);
                }
                else {
                    $ReqListSalleDispo = $db->preprare('SELECT numerosalle FROM salle WHERE numerosalle;');
                    $ReqListSalleDispo->execute();
                    $ListSalleDispo = $ReqListSalleDispo->fetch(PDO::FETCH_ASSOC);
                }

            }
            catch(PDOException $err) {
                echo $err;
            }

            return $ListSalleDispo;
        }
    }
?>