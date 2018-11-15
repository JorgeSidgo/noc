<?php 

class ControladorBase {
    public static function CreateView($view) {
        require_once "./app/view/$view.php";
    }

    public static function loadHeadOnly() {
        require_once "./app/view/Components/head.php";
    }

    public static function loadMain() {
        require_once "./app/view/Components/head.php";
        require_once "./app/view/Components/headerBar.php";
    }
}