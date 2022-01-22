<?php
 require_once("db.php");
class Functions extends DB{
  function verifValidAccessToken($access_token){
    try{
      $ReqExiToken=parent::$db->prepare("SELECT idsession FROM session WHERE accesstoken=:access_token");
      $ReqExiToken->bindParam(':access_token',$access_token,PDO::PARAM_STR);
      $ReqExiToken->execute();
      if($ReqExiToken->rowCount()>0){
        $sessionId=$ReqExiToken->fetch(PDO::FETCH_ASSOC)["idsession"];
        $ReqExiEXToken=parent::$db->prepare("SELECT 1 FROM session WHERE idsession=:idsession AND accesstokenexpiry>NOW()");
        $ReqExiEXToken->bindParam(':idsession',$sessionId,PDO::PARAM_INT);
        $ReqExiEXToken->execute();
        return $ReqExiEXToken->rowCount()>0 ? 2 : 1;
      }
      return 0;
    }catch(PDOException $err){
      echo("DATABASE error : ".$err);
      exit;
    }
  }
  function verifValidRefreshToken($refresh_token){
    try{
      $ReqExiToken=parent::$db->prepare("SELECT idsession FROM session WHERE refreshtoken=:refreshtoken");
      $ReqExiToken->bindParam(':refreshtoken',$refresh_token,PDO::PARAM_STR);
      $ReqExiToken->execute();
      if($ReqExiToken->rowCount()>0){
        $sessionId=$ReqExiToken->fetch(PDO::FETCH_ASSOC)["idsession"];
        $ReqExiEXToken=parent::$db->prepare("SELECT 1 FROM session WHERE idsession=:idsession AND refreshtokenexpiry>NOW()");
        $ReqExiEXToken->bindParam(':idsession',$sessionId,PDO::PARAM_INT);
        $ReqExiEXToken->execute();
        return $ReqExiEXToken->rowCount()>0 ? 2 : 1;
      }
      return 0;
    }catch(PDOException $err){
      echo("DATABASE error : ".$err);
      exit;
    }
  }
  function refresh(){
    //Check if access token and refresh token are in the same row
    $old_access_token=$_SESSION["access_token"];
    $old_refresh_token=$_SESSION["refresh_token"];
    $new_access_token=base64_encode(date('Y-m-d h:i:s').openssl_random_pseudo_bytes(24));
    $new_refresh_token=base64_encode(date('Y-m-d h:i:s').openssl_random_pseudo_bytes(24));
    $new_access_token_expiry=11800;
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
  function verifConnexion($access_token,$refresh_token){
    $verifAT=$this->verifValidAccessToken($access_token);
    $verifRT=$this->verifValidRefreshToken($refresh_token);
    error_log($verifRT);
    if($verifAT==2)
      return;
    else if($verifAT==1&&$verifRT==2){
      header('location:index.php?module=Connexion&action=refresh');
    }
    else{
      session_destroy();
      header('location:index.php?action=login');
    }

  }

}



?>
