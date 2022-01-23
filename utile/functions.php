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


  function getAvailableModules(){
      $availableModule=[
      "Home"=>"accueil",
      "Reservation"=>"reservation",
      "Lumiere"=>"lampe",
      "Porte"=>"porte",
      "Chauffage"=>"chauffage",
      "Help"=>"tickets"
    ];
      if ($this->getRole()=="admin") $availableModule["Admin"]="admin";
      return $availableModule;
  }

  function showNav($module){
    $modules=$this->getAvailableModules();
    $details=$this->getDetails();
    $str="";
    foreach ($modules as $key => $value) {
      if($value===$module)
        $str.='<li class="selected"><a href="index.php?module='.$value.'">'.$key.'</a></li>';
      else
        $str.='<li class=""><a href="index.php?module='.$value.'">'.$key.'</a></li>';
    }
    echo('
    <link rel="stylesheet" href="resources/styles/main.css" />
    <nav class="navBar">
      <button id="ham">HAM</button>
      <div class="profile">
        <img src="resources/img/image.png" alt="profilePiciture" class="profilePicture" />
        <p class="username">'.$details["nomutilisateur"].'</p>
      </div>
      <ul>
        '.
        $str
        .'
      </ul>
      <button class="logout" id="logout">Logout</button>
    </nav>
    ');
  }

  function verifConnexion(){
    if(isset($_SESSION["access_token"])){
        $access_token=$_SESSION["access_token"];
        $refresh_token=$_SESSION["refresh_token"];
    }
    else return -1;
    $verifAT=$this->verifValidAccessToken($access_token);
    $verifRT=$this->verifValidRefreshToken($refresh_token);
    if($verifAT==2){
      return 1;
    }
    else if($verifAT==1&&$verifRT==2){
      header('location:index.php?module=connexion&action=refresh');
    }
    else{
      session_destroy();
      header('location:index.php?module=connexion&action=login');
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

$function=new Functions();

?>
