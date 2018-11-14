<?php

class Sistema extends ControladorBase {

    // Vistas

    public static function loginView() {
        self::loadMain();
        require_once './app/view/Sistema/login.php';
    }

    public static function registroForm() {
        self::loadMain();
        require_once './app/view/Sistema/registro.php';
    }

    // Métodos 

    public static function login() {
        $nomUsuario = $_REQUEST["user"];
        $pass = $_REQUEST["pass"];

        $dao = new DaoUsuario();
        $dao->objeto->setNomUsuario($nomUsuario);

        $dao->login();
    }

}