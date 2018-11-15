<?php 

class Conexion {

    public static $host = "localhost";
    public static $dbName = "deloitte_mensajeria";
    public static $dbUser = "root";
    public static $dbPass = "";

    private static function connect() {
        $options = [
            PDO::ATTR_EMULATE_PREPARES   => false, 
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
          ];
        $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";charset=utf8", self::$dbUser, self::$dbPass, $options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function query($query, $params = array()) {

        try {
            $stmt = self::connect()->prepare($query);
            $stmt->execute($params);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            var_dump($data);
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}