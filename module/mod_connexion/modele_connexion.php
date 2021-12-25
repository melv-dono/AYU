<?php
require_once('./db.php');
Class Modele_connexion{

  function insertSession($username,$password){
      try{
        $ReqExiUserDetails=$db->prepare("SELECT userid,motdepasse FROM user WHERE nomutilisateur=:username");
        $ReqExiUserDetails->bindParam(":username",$username,PDO::PARAM_STR);
        $ReqExiUserDetails->execute();
        $rowCount=$ReqExiUserDetails->rowCount();
        $ReqExiUserDetails->rowCount()<1 ? sendError("Not Authorize") : false;
        // Fetch data userid and password
        $UserDetails=$ReqExiUserDetails->fetch(PDO::FETCH_ASSOC);
        $returned_UserId=$UserDetails['userid'];
        $returned_Password_Hash=$UserDetails['motdepasse'];
        // Verify correct password
        !password_verify($password,$returned_Password_Hash) ? sendError() : false;
        // Génerate unique tokens
        $access_token=base64_encode(bin2hex(date('Y-m-d h:m:s').openssl_random_pseudo_bytes(24)));
        $refresh_token=base64_encode(bin2hex(date('Y-m-d h:m:s').openssl_random_pseudo_bytes(24)));
        $access_token_expiry=1800;
        $refresh_token_expiry=86400;
        //
        $InsNewSession=$db->prepare("INSERT INTO session (userid,accesstoken,accesstokenexpiry,refreshtoken,refreshtokenexpiry)
          VALUES (:userid,:access_token,date_add(NOW(), INTERVAL :accesstokenexpiry SECOND),:refresh_token,date_add(NOW(), INTERVAL :refreshtokenexpiry SECOND))");
        $InsNewSession->bindParam(":userid", $userid, PDO::PARAM_INT);
        $InsNewSession->bindParam(":acces_token", $access_token, PDO::PARAM_STR);
        $InsNewSession->bindParam(":refresh_token", $refresh_token, PDO::PARAM_STR);
        $InsNewSession->bindParam(":accesstokenexpiry", $access_token_expiry, PDO::PARAM_INT);
        $InsNewSession->bindParam(":refreshtokenexpiry", $refresh_token_expiry, PDO::PARAM_INT);
        $InsNewSession->execute();
        $InsNewSession->rowCount()<1 ? sendError("No row insert") : false;
      }catch(PDOException $err){
        error_log('Database error : '.$err);
        sendError($err);
      }
  }

  // Insert into user table new user
  function inscription($username, $password){
    try{
      $InsNewUser=$db->prepare("INSERT INTO ")

    }catch(PDOException $err){

    }
  }
  function sendError($error){
    echo $error;
    exit(-1);
  }

}
?>
