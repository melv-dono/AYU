<?php
require_once("./db.php");
require_once("./module/mod_connexion/mod_connexion.php");

$modConnexion = new Mod_connexion();
$modConnexion->display();
