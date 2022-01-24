<?php
require_once("db.php");
    class Modele_accueil extends DB {
      //  Get list module disponnible
      function getAvailableModules(){
          $availableModule=["Home","Reservation","Lumiere","Porte","Chauffage","Help"];
          if ($this->getRole()=="admin") $availableModule[]="Admin";
          return $availableModule;
      }

      //
      function getReservation(){
        $access_token=$_SESSION["access_token"];
        try{
          $ReqLisReservation=parent::$db->prepare("SELECT idreserv,dateD,heure,numeroSalle FROM reservation INNER JOIN session USING(userid) WHERE accesstoken=:access_token");
          $ReqLisReservation->bindparam("access_token",$access_token,PDO::PARAM_STR);
          $ReqLisReservation->execute();
          if($ReqLisReservation->rowCount()>0)
            return $ReqLisReservation->fetchAll(PDO::FETCH_ASSOC);
          else
            return -1;
        }catch(PDOException $err){
          echo("DATABASE error : ".$err);
          exit;
        }
      }
      function getDetails(){
        $access_token=$_SESSION["access_token"];
        try{
          $ReqUsrDetails=parent::$db->prepare("SELECT nomutilisateur,prenom,nom,role FROM user INNER JOIN session USING(userid) WHERE accesstoken=:access_token");
          $ReqUsrDetails->bindparam("access_token",$access_token,PDO::PARAM_STR);
          $ReqUsrDetails->execute();
          if($ReqUsrDetails->rowCount()>0)
            return $ReqUsrDetails->fetch(PDO::FETCH_ASSOC);
          else
            return -1;
        }catch(PDOException $err){
          echo("DATABASE error : ".$err);
          exit;
        }
      }
      function getRole(){
        $access_token=$_SESSION["access_token"];
        try{
          $ReqUsrRole=parent::$db->prepare("SELECT role FROM user INNER JOIN session USING(userid) WHERE accesstoken=:access_token");
          $ReqUsrRole->bindparam("access_token",$access_token,PDO::PARAM_STR);
          $ReqUsrRole->execute();
          if($ReqUsrRole->rowCount()>0)
            return $ReqUsrRole->fetch(PDO::FETCH_ASSOC)["role"];
          else
            return -1;
        }catch(PDOException $err){
          echo("DATABASE error : ".$err);
          exit;
        }
      }
    }
?>
