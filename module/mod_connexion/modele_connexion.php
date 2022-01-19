<?php

require_once('./db.php');
Class Modele_connexion extends DB{
 
  function insertSession($username,$password){
      try{
        // Select if exist user in tbl=User
        $ReqExiUserDetails=parent::$db->prepare("SELECT userid,motdepasse FROM user WHERE nomutilisateur=:username");
        $ReqExiUserDetails->bindParam(":username",$username,PDO::PARAM_STR);
        $ReqExiUserDetails->execute();
        $rowCount=$ReqExiUserDetails->rowCount();
        $ReqExiUserDetails->rowCount()<1 ? $this->sendError("Not Authorize") : false;
        // Fetch data userid and password
        $UserDetails=$ReqExiUserDetails->fetch(PDO::FETCH_ASSOC);
        $returned_UserId=$UserDetails['userid'];
        $returned_Password_Hash=$UserDetails['motdepasse'];
        // Verify correct password
        !password_verify($password,$returned_Password_Hash) ? $this->sendError() : false;
        // Génerate unique tokens
        $access_token=base64_encode(bin2hex(date('Y-m-d h:m:s').openssl_random_pseudo_bytes(24)));
        $refresh_token=base64_encode(bin2hex(date('Y-m-d h:m:s').openssl_random_pseudo_bytes(24)));
        $access_token_expiry=1800;
        $refresh_token_expiry=86400;
        //
        $InsNewSession=parent::$db->prepare("INSERT INTO session (userid,accesstoken,accesstokenexpiry,refreshtoken,refreshtokenexpiry)
          VALUES (:userid,:access_token,date_add(NOW(), INTERVAL :accesstokenexpiry SECOND),:refresh_token,date_add(NOW(), INTERVAL :refreshtokenexpiry SECOND))");
        $InsNewSession->bindParam(":userid", $returned_UserId, PDO::PARAM_INT);
        $InsNewSession->bindParam(":access_token", $access_token, PDO::PARAM_STR);
        $InsNewSession->bindParam(":refresh_token", $refresh_token, PDO::PARAM_STR);
        $InsNewSession->bindParam(":accesstokenexpiry", $access_token_expiry, PDO::PARAM_INT);
        $InsNewSession->bindParam(":refreshtokenexpiry", $refresh_token_expiry, PDO::PARAM_INT);
        $InsNewSession->execute();
        if($InsNewSession->rowCount()>1) {
          $_SESSION[access_token]=$access_token;
          $_SESSION[refresh_token]=$refresh_token;
          return 1;
        }
        return -1;
      }catch(PDOException $err){
        error_log('Database error : '.$err);
        sendError($err);
      }
  }
  // Insert into user table new user
  function signin($username, $password, $firstname, $lastname, $role){
    $this->checkIfExist($username)<1 ? $this->sendError("User already exist") : false;
    $hashed_password=password_hash($password,PASSWORD_DEFAULT);
    try{
      $InsNewUser=parent::$db->prepare("INSERT INTO user (nomUtilisateur,motdepasse,prenom,nom,datecreation)
      VALUES (:username,:password,:firstname,:lastname,NOW())");
      $InsNewUser->bindParam(":username",$username,PDO::PARAM_STR);
      $InsNewUser->bindParam(":password",$hashed_password,PDO::PARAM_STR);
      $InsNewUser->bindParam(":firstname",$firstname,PDO::PARAM_STR);
      $InsNewUser->bindParam(":lastname",$lastname,PDO::PARAM_STR);
      $InsNewUser->execute();
      $InsNewUser->debugDumpParams();
      var_dump($InsNewUser);
      echo($InsNewUser->rowCount());
      return $InsNewUser->rowCount()<1 ? 0 : 1;
    }catch(PDOException $err){
      echo($err);
      error_log($err);
    }
  }
  
  function refresh(){
    //Check if access token and refresh token are in the same row 
    $old_access_token=$_SESSION["access_token"];
    $old_refresh_token=$_SESSION["refresh_token"];
    $new_access_token=base64_encode(bin2hex(date('Y-m-d h:m:s').openssl_random_pseudo_bytes(24)));
    $new_refresh_token=base64_encode(bin2hex(date('Y-m-d h:m:s').openssl_random_pseudo_bytes(24)));
    $new_access_token_expiry=1800;
    $new_refresh_token_expiry=86400;
    try{
        //SELECT session from specified access_token
        $UpdSession=parent::$db->prepare(
        "UPDATE 
          session 
        SET 
          accesstoken=:access_token,refreshtoken=:refresh_token,
          accesstokenexpiry=date_add(NOW(), INTERVAL :accesstokenexpiry SECOND),
          refreshtokenexpiry=date_add(NOW(), INTERVAL :refreshtokenexpiry SECOND)
        WHERE
          accesstoken=:old_access_token AND
          refreshtoken=:old_refresh_token 
        ");
        //bind all params
        $UpdSession->bindparam(":access_token", $new_access_token, PDO::PARAM_STR);
        $UpdSession->bindparam(":refresh_token", $new_refresh_token, PDO::PARAM_STR);
        $UpdSession->bindparam(":accesstokenexpiry", $new_access_token_expiry, PDO::PARAM_STR);
        $UpdSession->bindparam(":refreshtokenexpiry", $new_refresh_token_expiry, PDO::PARAM_STR);
        $UpdSession->bindparam(":old_access_token", $old_access_token, PDO::PARAM_STR);
        $UpdSession->bindparam(":old_refresh_token", $old_refresh_token, PDO::PARAM_STR);
        $UpdSession->execute();
        //
        if($UpdSession->rowCount()>0) {
          $_SESSION["access_token"]=$new_access_token;
          $_SESSION["refresh_token"]=$new_refresh_token;
          return 1;
        }
        return -1;
    }catch(PDOException $err){
      echo("Database error : ". $err);
      return -1;
    }
  }

  function sendError($error){
    echo $error;
    exit(-1);
  }

  function checkIfExist($username){
    try{
      $ReqExiUser=parent::$db->prepare("SELECT userid FROM user WHERE username=:username");
      $ReqExiUser->bindParam(":username", $username,PDO::PARAM_STR);
      $ReqExiUser->execute();
      return $ReqExiUser->rowCount()<0? 0 : 1;
    }catch(PDOException $err){
      sendError($err);
    }
  }

}
?>
