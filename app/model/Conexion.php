<?php 

class Conexion {

    public static $host = "localhost";
    public static $dbName = "deloitte_mensajeria";
    public static $dbUser = "root";
    public static $dbPass = "";

    private static function connect() {
        $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";charset=utf8", self::$dbUser, self::$dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function query($query, $params = array()) {
        $stmt = self::con()->prepare($query);
        $stmt->execute($params);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}