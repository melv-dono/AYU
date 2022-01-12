<?php
require_once('./db.php');
Class Modele_connexion{

  function insertSession($username,$password){
      try{
        // Select if exist user in tbl=User
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
        return $InsNewSession->rowCount()<1 ? 0 : 1;
      }catch(PDOException $err){
        error_log('Database error : '.$err);
        sendError($err);
      }
  }
  // Insert into user table new user
  function signin($username, $password, $firstname, $lastname, $role){
    checkIfExist($username)<1 ? sendError("User already exist") : false;
    $hashed_password=password_hash($password,"PASSWORD_DEFAULT");
    try{
      $InsNewUser=$db->prepare("INSERT INTO user (nomUtilisateur,password,prenom,nom,role,datecreation)
      VALUES (:username,:password,:firstname,:lastname,:role,NOW())");
      $InsNewUser->bindParam(":username",$username,PDO::PARAM_STR);
      $InsNewUser->bindParam(":password",$hashed_password,PDO::PARAM_STR);
      $InsNewUser->bindParam(":firstname",$firstname,PDO::PARAM_STR);
      $InsNewuser->bindParam(":lastname",$lastname,PDO::PARAM_STR);
      $InsNewUser->bindParam(":role",$role,PDO::PARAM_STR);
      $InsNewUser->execute();
      return $InsNewUser->rowCount()<1 ? 0 : 1;
    }catch(PDOException $err){
      error_log($err);
    }
  }

  function sendError($error){
    echo $error;
    exit(-1);
  }

  function checkIfExist($username){
    try{
      $ReqExiUser=$db->prepare("SELECT userid FROM user WHERE username=:username");
      $ReqExiUser->bindParam(":username", $username,PDO::PARAM_STR);
      $ReqExiUser->execute();
      return $ReqExiUser->rowCount()<0? 0 : 1;
    }catch(PDOException $err){
      sendError($err);
    }
  }

}
?>
