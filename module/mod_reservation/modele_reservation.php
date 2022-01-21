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

        public function reserver($date, $heure, $salle) {
            // Attention modification BD
            $success=0;
            //$dureeMin = new DateInterval('PT30M'); // déjà gérer grâce à la valeur par défaut du input
            // if (!isset($duree) && !isset($date))
            //     return $success;
            // else {
            //     $debutResa = new DateTime($date);
            // }
            //isset($this->debut) ? $debutResa = new DateTime() : $debutResa = $this->debut;
            //isset($this->fin) || ($this->fin->diff($debutResa)) < 30 ? $finResa = $debutResa->add($dureeMin) : $finResa =  $this->fin;  

            // $ReqIdResa = $db->prepare('SELECT idReserv FROM reservation WHERE numerosalle=? and debutreserv = ?;');
            // $ReqIdResa->execute(array($salle), array($debutResa));
            // $IdResa = $ReqIdResa->fetch(PDO::FETCH_OBJ);

            if (!isset($IdResaesa)) {
                //TO DO : Vérification du userId avec le token avant la requête
                // $userId = getUserId();
                $userId = 1;
                $InsResa = parent::$db->prepare('INSERT INTO reservation VALUES (DEFAULT, ?, ?, ?, ?);');
                $InsResa->execute(array($userId, $date, $heure, $salle));
                $rowCount=$InsResa->rowCount();
                $rowCount<1 ? $success=0 : $success=1;
            }
            echo $success;
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

        // Liste de toutes salles
        function sallesDispo() {
            $ReqSallesDispo = parent::$db->prepare('SELECT numerosalle FROM salle;');
            $ReqSallesDispo->execute();
            $SalleDispo = $ReqSallesDispo->fetch(PDO::FETCH_ASSOC);            
            return $SalleDispo;
        }

        // Attention test à supprimer lors du refactor
        function creneauxReserve($date, $salle) {
            try {
                // Récuperation du nombre de créneaux réservés
                $ReqCreneaux = parent::$db->prepare('SELECT count(idreserv) as nbResa FROM reservation WHERE dateD = ? and numerosalle = ? ;');
                $ReqCreneaux->execute(array($date, $salle));
                $Creneaux= $ReqCreneaux->fetch(PDO::FETCH_ASSOC);

                // Récupération des créneaux dispo
                if ((int)$Creneaux['nbResa'] < 10) {
                    $ReqListCreneaux = parent::$db->prepare('SELECT HOUR(cast(heure as time)) as heure2 FROM reservation WHERE dateD = ? and numerosalle = ? ORDER BY heure;');
                    $ReqListCreneaux->execute(array($date, $salle));
                    $ListCreneaux = $ReqListCreneaux->fetchAll(PDO::FETCH_ASSOC);
                    $creneauxDispo = $this->creneauxDispo($ListCreneaux);
                    // echo "This is the first available : " . $creneauxDispo[0];
                    return $creneauxDispo;
                }
                // Aucune réservation dispo
                else
                    return array();

            }
            catch(PDOException $err) {
                echo $err;
            }
        }

        function creneauxDispo($list) {
            $length = count($list);
            $i = 0;
            for ($x = 9; $x < 19; $x++) {
                if ($i < $length && (int)$list[$i]['heure2'] == $x) {
                    $i++;
                }
                else {
                    $creneauxDispo[] = $x;
                }
            }
            return $creneauxDispo;
        }
    }
    Connexion::initConnexion();
    // $a = new Modele_reservation();
    // $a->reserver('2022-01-28 00:00:00', '2022-01-28 12:00:00', 'B112');
    // $a->creneauxReserve('20220120', 'B112');
    // var_dump(date("Y-m-d"));
?>