<?php 

class Conexion {

    public static $host = "localhost";
    public static $dbUser = "root";
    public static $dbPass = "";
    public static $dbName = "deloitte_mensajeria";

    public static function conectar() {
        $con = new mysqli(self::$host, self::$dbUser, self::$dbPass, self::$dbName);

        if($con)
            return $con;
    }

}