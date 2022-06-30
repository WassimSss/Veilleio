<?php
/**
 * Retourne une connexion a la base de donéées
 * 
 * @return PDO
 */

class Database {
    private static $instance = null;

    public static function getPdo() : PDO{

        if(self::$instance === null) {
            $dbName="veilleio";
            $dbUsername="root";
            $dbPassword="";
            self::$instance = new PDO("mysql:host=localhost;dbname=$dbName;charset=utf8", "$dbUsername", "$dbPassword", [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

        }
        
        return self::$instance;
        
    }
}






