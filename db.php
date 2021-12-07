<?php
try{
  //mysql:HOST;dbname,id,mdp:
  require_once("./identifiants.php");
   $db=new PDO($dns,$user,$password);
   echo "U r connected";
}catch(PDOException $err){
  error_log("Database error : ".$err);
  echo $err;
  exit -1;
}


 ?>
