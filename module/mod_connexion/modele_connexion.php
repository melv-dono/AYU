<?php
require_once('./db.php');
Class Modele_connexion{

  function insertSession($username,$password){
      try{
        $ReqExiUserDetails=$db->prepare("SELECT userid,motdepasse FROM user WHERE nomutilisateur=:username");
        $ReqExiUserDetails->bindParam(":username",$username,PDO::PARAM_STR);
        $ReqExiUserDetails->execute();
        //
        $rowCount=$ReqExiUserDetails->rowCount();
        $rowCount<1 ? sendError("Ton compte n'existe pas") : false;
        //
        $access_token=bin2hex(date('Y-m-d h:m:s').openssl_random_pseudo_bytes(24));
        $refresh_token=bin2hex(date('Y-m-d h:m:s').openssl_random_pseudo_bytes(24));
        $access_token_expiry=1800;
        $refresh_token_expiry=86400;
        $InsNewSession=$db->prepare("INSERT INTO session ()");
      }catch(PDOException $err){
        sendError($err);
      }
  }

  function sendError($error){
    echo $error;
    exit(-1);
  }

}
?>
