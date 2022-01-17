<?php
    // require_once('./../../db.php');
    // require_once('../../utile/user.php');
    require_once('temp_Connexion.php');
    
    class Modele_reservation extends Connexion{

        function __construct() {
            // Attention cette partie du code est mtn dans le conterolleur
            // // Donc modifier le reste de la classe plus tard
            // $this->salle = htmlspecialchars($_GET['salle']);
            // $this->date = htmlspecialchars($_GET['date']);
            // $this->heure = htmlspecialchars($_GET['heure']);
            // $this->duree = htmlspecialchars($_GET['duree']);
            // $this->fin = htmlspecialchars($_GET['fin']); // facultatif
        }

        public function reserver($salle, $date, $heure, $duree) {
            // Attention modification BD
            $success=0;
            //$dureeMin = new DateInterval('PT30M'); // déjà gérer grâce à la valeur par défaut du input
            if (!isset($duree) && !isset($date))
                return $success;
            else {
                $debutResa = new DateTime($date);
            }
            //isset($this->debut) ? $debutResa = new DateTime() : $debutResa = $this->debut;
            //isset($this->fin) || ($this->fin->diff($debutResa)) < 30 ? $finResa = $debutResa->add($dureeMin) : $finResa =  $this->fin;  

            $ReqIdResa = $db->prepare('SELECT idReserv FROM reservation WHERE numerosalle=? and debutreserv = ?;');
            $ReqIdResa->execute(array($salle), array($debutResa));
            $IdResa = $ReqIdResa->fetch(PDO::FETCH_OBJ);

            if (!isset($IdResaesa)) {
                //TO DO : Vérification du userId avec le token avant la requête
                // $userId = getUserId();
                $userId = 1;
                $InsResa = $db->prepare('INSERT INTO reservation VALUES (DEFAULT, ?, ?, ?, ?);');
                $InsResa->execute(array($userId), array($debutResa), array($finResa), array($this->salle));
                $rowCount=$InsResa->rowCount();
                $rowCount<1 ? $success=0 : $success=1;
            }
            return $success;
        }

        // Surment à supprimer
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

        function creneauxReserve($date, $salle) {
            // Verifier que la requète et bonne et que le execute avec une liste fonction bien
            // Voir dans quelle mesure il est possible de cast un FETCH_OBJ en array()
            try {
                // Récuperation des créneaux disponibles
                $ReqCreneaux = parent::$db->prepare('SELECT count(idreserv) FROM reservation WHERE dateD = ? and numerosalle = ? ;');
                $ReqCreneaux->execute(array($date, $salle));
                $Creneaux= $ReqCreneaux->fetch(PDO::FETCH_ASSOC);

                // Récupération des créneaux inf à la limite (10)
                // Un return vide signifie aucun créneau réservé
                // Faire une var global pour la limite de resa (10)
                if ($ReqCreneaux->rowCount() == 0 || ($ReqCreneaux->rowCount() >0 && (int)$Creneaux['count(idreserv)'] < 10)) {
                    $ReqListCreneaux = parent::$db->prepare('SELECT heure FROM reservation WHERE dateD = ? and numerosalle = ? ORDER BY heure;');
                    $ReqListCreneaux->execute(array($date, $salle));
                    $ListCreneaux = $ReqListCreneaux->fetchAll(PDO::FETCH_ASSOC);
                    var_dump($ListCreneaux[0]['heure']);
                    echo count($ListCreneaux);
                }
                else {
                    //Attention mieux gérer le problème
                    echo "Il n'a plus de réservation disposible";
                }

            }
            catch(PDOException $err) {
                echo $err;
            }
        }

        function creneauxDispo($list) {
            $length = count($list);
            $creneauxDispo = array(10 - $length);
            for ($j=0; $j< 10-$length; $j++) {
                $bool = true;
                $value = $j + 9;

                for ($i = 0; $i<$length; $i++) {
                    if ($list[i]['heure'] == $value)
                        $bool = false;
                }

                if ($bool)
                    $creneauxDispo[j] = $value;
            }
        }
    }
    Connexion::initConnexion();
    $a = new Modele_reservation();
    $a->creneauxReserve('20220120', 'B112');
    // SELECT count(idreserv) FROM reservation WHERE date = '20220120' and numerosalle = 'B112' 

?>