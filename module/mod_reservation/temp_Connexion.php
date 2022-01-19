<?php
    class Connexion {
        
        protected static $db;

        public static function initConnexion() {

            // $dns ='mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201610;charset=utf8';
            // $user = 'dutinfopw201610';
            // $password = 'tanehyhu';

            $dns ='mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201610;charset=utf8';
            $user = 'dutinfopw201610';
            $password = 'tanehyhu';
          
            try {
            self::$db =  new PDO($dns, $user, $password);  
            }            

            catch (PDOException $pdo) {
                echo $pdo->getMessage().$pdo->getCode();
            }
        }
    }
?>