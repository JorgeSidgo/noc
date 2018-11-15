<?php

class Sistema extends ControladorBase {

    // Vistas y otras mierdas

    public static function loginView() {
        self::loadHeadOnly();
        require_once './app/view/Sistema/login.php';
    }

    public static function registroForm() {
        self::loadHeadOnly();
        require_once './app/view/Sistema/registro.php';
    }
    
    public static function dashboard() {
        self::loadMain();
        require_once './app/view/Sistema/dashboard.php';
    }

    // Métodos 

    public static function login() {
        $datos = $_REQUEST["datos"];

        $datos = json_decode($datos);


        $dao = new DaoUsuario();
        $dao->objeto->setNomUsuario($datos->user);
        $dao->objeto->setPass($datos->pass);
        
        $dao->login();
    }

}