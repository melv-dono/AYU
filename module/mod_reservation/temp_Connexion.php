<?php
    class Connexion {
        
        protected static $db;

        public static function initConnexion() {
            try {
            self::$db =  new PDO("mysql:host=eu02-sql.pebblehost.com;dbname=customer_184435_ayu", "customer_184435_ayu", "DuCFDbMxmW@sMLvLJW2m");  
            }
            catch (PDOException $pdo) {
                echo $pdo->getMessage().$pdo->getCode();
            }
        }
    }
?>