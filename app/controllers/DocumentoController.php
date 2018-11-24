<?php 

class DocumentoController extends ControladorBase {

    // Vistas 

    public function gestion() {
        self::loadMain();
        require_once './app/view/Documento/gestion.php';
    }

}