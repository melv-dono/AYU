<?php
class DB{

  protected static $db;

  public static function initConnexion(){
      try {
          require_once("identifiants.php");
          self::$db = new PDO($dns,$user,$password); //Connexion a la Base de Données
      } catch (Exception $e) {
          die('Error : ' . $e->getMessage());
      }
  }
}
DB::initConnexion();

?>
