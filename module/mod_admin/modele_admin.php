<?php
  require_once("db.php");
class Modele_admin extends DB{
    function listAllUsers(){
      try{
        $ReqLisUsers=parent::$db->prepare("SELECT userid,nomUtilisateur,prenom,nom,role,datecreation FROM user");
        $ReqLisUsers->execute();
        return $ReqLisUsers->fetchAll(PDO::FETCH_ASSOC);
      }catch(PDOException $err){
        http_status_code(500);
        error_log($err);
      }
    }

    function listAllTickets(){
      try{
        $ReqLisTickets=parent::$db->prepare("SELECT idticket,objet,requete,traite,numerosalle,userid FROM tickets");
        $ReqLisTickets->execute();
        return $ReqLisTickets->fetchAll(PDO::FETCH_ASSOC);
      }catch(PDOException $err){
        http_status_code(500);
        error_log($err);
      }
    }

    function deleteUser($userId){
      try{
        $DelUser=parent::$db->prepare("DELETE FROM user WHERE userid=:userid");
        $DelUser->bindParam(":userid",$userId,PDO::PARAM_INT);
        $DelUser->execute();
        return $DelUser->rowCount();
      }catch(PDOException $err){
        http_status_code(500);
        error_log($err);
    }
  }

    function changeRole($role){
      try{
        $UpdRole=parent::$db->prepare("UPDATE user SET role=:role WHERE userid=:userid");
        $UpdRole->bindParam(":role",$role,PDO::PARAM_STR);
        $UpdRole->execute();
        return $UpdRole->rowCount();
      }catch(PDOException $err){
        http_status_code(500);
        error_log($err);
      }
    }

    function listEquipement(){
      try{
        $ReqLisEquipement=parent::$db->prepare("SELECT idequipement,nom,enpanne,etat,numerosalle,idtype FROM equipement");
        $ReqLisEquipement->execute();
        return $ReqLisEquipement->fetchAll(PDO::FETCH_ASSOC);
      }catch(PDOException $err){
        http_status_code(500);
        error_log($err);
      }
    }

    function listEquipementSalle($salle){
      try{
        $ReqLisEquipement=parent::$db->prepare("SELECT idequipement,nom,enpanne,etat,numerosalle,idtype FROM equipement WHERE numerosalle=:numeroSalle");
        $ReqLisEquipement->bindParam(":numeroSalle",$salle,PDO::PARAM_STR);
        $ReqLisEquipement->execute();
        return $ReqLisEquipement->fetchAll(PDO::FETCH_ASSOC);
      }catch(PDOException $err){
        http_status_code(500);
        error_log($err);
      }
    }

    function addEquipement($nom,$enpanne,$etat,$numeroSalle,$type){
      try{
        $InsNewEquipement=parent::$db->prepare("INSERT INTO equipement(nom,enpanne,etat,numerosalle,idtype) VALUES (:nom,:enpanne,:etat,:numerosalle,:idtype)");
        $InsNewEquipement->bindParam(":nom",$nom,PDO::PARAM_STR);
        $InsNewEquipement->bindParam(":enpanne",$enpanne,PDO::PARAM_INT);
        $InsNewEquipement->bindParam(":etat",$etat,PDO::PARAM_INT);
        $InsNewEquipement->bindParam(":numerosalle",$numeroSalle,PDO::PARAM_STR);
        $InsNewEquipement->bindParam(":idtype",$type,PDO::PARAM_INT);
        $InsNewEquipement->execute();
        return $InsNewEquipement->rowCount();
      }catch(PDOException $err ){
        http_status_code(500);
        error_log($err);
      }
  }

    function deleteEquipement($id){
      try{
        $DelEquipement=parent::$db->prepare("DELETE FROM equipement WHERE idequipement=:id");
        $DelEquipement->bindParam(":id",$id,PDO::PARAM_INT);
        $DelEquipement->execute();
        return $DelEquipement->rowCount();
      }catch(PDOException $err ){
        http_status_code(500);
        error_log($err);
      }
    }

    function deleteTicket($id){
      try{
        $DelTicket=parent::$db->prepare("DELETE FROM ticket WHERE idticket=:id");
        $DelTicket->bindParam(":id",$id,PDO::PARAM_INT);
        return $DelTicket->rowCount();
        $DelTicket->execute();
      }catch(PDOException $err ){
        http_status_code(500);
        error_log($err);
      }
    }

    function listSalles(){
      try{
        $ReqLisSalles=parent::$db->prepare("SELECT numerosalle,capacite,nbpostes FROM salle");
        $ReqLisSalles->execute();
        return $ReqLisSalles->fetchAll(PDO::FETCH_ASSOC);
      }catch(PDOException $err){
        http_status_code(500);
        error_log($err);
      }
    }

    function addSalle($numerosalle,$capacite,$nbpostes){
      try{
        $InsNewSalle=parent::$db->prepare("INSERT INTO salle(numerosalle,capacite,nbpostes) VALUES (:numerosalle,:capacite,:nbpostes)");
        $InsNewSalle->bindParam(":numerosalle",$numerosalle,PDO::PARAM_STR);
        $InsNewSalle->bindParam(":capacite",$capacite,PDO::PARAM_INT);
        $InsNewSalle->bindParam(":nbpostes",$nbpostes,PDO::PARAM_INT);
        $InsNewSalle->execute();
        return $InsNewSalle->rowCount();
      }catch(PDOException $err ){
        http_status_code(500);
        error_log($err);
    }
  }

    function deleteSalle(){
      try{
        $DelSalle=parent::$db->prepare("DELETE FROM salle WHERE numerosalle=:numeroSalle");
        $DelSalle->bindParam(":id",$id,PDO::PARAM_INT);
        $DelSalle->execute();
        return $DelSalle->rowCount();
      }catch(PDOException $err ){
        http_status_code(500);
        error_log($err);
      }
  }

}


?>
