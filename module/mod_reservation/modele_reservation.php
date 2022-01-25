<?php

    require_once('db.php');

    class Modele_reservation extends DB{

      // Delete reservation
      function deleteReservation($idRes){
        try {
          require_once(FUNCTIONS);
          $function=new Functions;
          $userid=$function->getDetails()["userid"];

          if($function->is_admin()>0){
            $DelExiRes=parent::$db->prepare("DELETE FROM reservation WHERE idreserv=:idres");
            $DelExiRes->bindParam(':idres',$idRes, PDO::PARAM_INT);
          }
          else {
              $DelExiRes= parent::$db->prepare("DELETE FROM reservation WHERE idreserv=:idres AND userid=:userid");
               $DelExiRes->bindParam(':idres',$idRes, PDO::PARAM_INT);
               $DelExiRes->bindParam(':userid',$userid, PDO::PARAM_INT);
          }
          $DelExiRes->execute();
        $DelExiRes->debugDumpParams();
          return $DelExiRes->rowCount();
        } catch (PDOException $err) {
          http_status_code(500);
          error_log("DATABASE ERROR : ".$err);
        }

      }




        public function reserver($date, $heure, $salle) {
            // Attention modification BD
            $success=0;
            if (!isset($IdResaesa)) {
                //TO DO : Vérification du userId avec le token avant la requête
                require_once(FUNCTIONS);
                $function=new Functions;
                $userId = $function->getDetails()['userid'];
                $InsResa = parent::$db->prepare('INSERT INTO reservation VALUES (DEFAULT, ?, ?, ?, ?);');
                $InsResa->execute(array($userId, $date, $heure, $salle));
                $rowCount=$InsResa->rowCount();
                $rowCount<1 ? $success=0 : $success=1;
            }
            return $success;
        }

        // Liste de toutes salles
        function sallesDispo() {
            $ReqSallesDispo = parent::$db->prepare('SELECT numerosalle FROM salle;');
            $ReqSallesDispo->execute();
            $SalleDispo = $ReqSallesDispo->fetchAll(PDO::FETCH_ASSOC);
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
?>
