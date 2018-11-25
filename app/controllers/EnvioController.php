<?php 

class EnvioController extends ControladorBase {

    // Vistas
    public function nuevoEnvio() {
        self::loadMain();
        $daoA = new DaoArea();
        $areas = $daoA->mostrarAreas();

        $daoC = new DaoCliente();
        $clientes = $daoC->mostrarClientesCmb();

        $daoD = new DaoDocumento();
        $documentos = $daoD->mostrarDocumentosCmb();
        require_once './app/view/Envio/nuevo.php';
    }

    public function misEnvios() {
        self::loadMain();
        require_once './app/view/Envio/misEnvios.php';
    }

}