<?php 

class EnvioController extends ControladorBase {

    // Vistas
    public function nuevoEnvio() {
        self::loadMain();
        require_once './app/view/Envio/nuevo.php';
    }

    public function misEnvios() {
        self::loadMain();
        require_once './app/view/Envio/misEnvios.php';
    }

}