<?php 

class ControladorBase {

    public static function CreateView($view) {
        require_once "./app/view/$view.php";
    }

    public static function loadHeadOnly() {
        session_start();
        require_once "./app/view/Components/headLogin.php";
    }

    public static function loadMain() {
        session_start();
        require_once "./app/view/Components/head.php";
        require_once "./app/view/Components/headerBar.php";
    }
}