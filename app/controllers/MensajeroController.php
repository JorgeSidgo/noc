<?php

class MensajeroController extends ControladorBase {

    public static function gestion() {
        self::loadMain();
        
        require_once './app/view/Mensajeros/gestion.php';
    }




    public function mostrarMensajeros() {
        
    }

}