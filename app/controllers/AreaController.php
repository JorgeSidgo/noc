<?php 

class AreaController extends ControladorBase {

    public function gestion() {
        self::loadMain();
        require_once './app/view/Area/gestion.php';
    }

}