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


    // Métodos 

    public function registrarEnvio() {

        session_start();

        $detalles = json_decode($_REQUEST["detalles"]);

        $dao = new DaoEnvio();
        
        $dao->objeto->setCodigoUsuario($_SESSION["codigoUsuario"]);

        $codigoEnvio = $dao->encabezadoEnvio();

        $dao->objeto->setCodigoEnvio($codigoEnvio);
        
        $dao->objeto->setCodigoTipoTramite($detalles[0]->tramite);
        $dao->objeto->setCodigoCliente($detalles[0]->cliente);
        $dao->objeto->setCodigoTipoDocumento($detalles[0]->tipoDocumento);
        $dao->objeto->setCodigoArea($detalles[0]->area);
        $dao->objeto->setMonto($detalles[0]->monto);
        $dao->objeto->setObservacion($detalles[0]->observaciones);

        $resultado = $dao->registrarDetalleEnvio();

        var_dump($resultado);

        /* foreach($detalles as $detalle) {
            $dao->objeto->setCodigoTipoTramite($detalle->tramite);
            $dao->objeto->setCodigoCliente($detalle->cliente);
            $dao->objeto->setCodigoTipoDocumento($detalle->tipoDocumento);
            $dao->objeto->setCodigoArea($detalle->area);
            $dao->objeto->setMonto($detalle->monto);
            $dao->objeto->setObservacion($detalle->observaciones);

            if($dao->registrarDetalleEnvio()) {
                $contador++;
            } else 
            {
                echo "nell";
                die();
            }
        }


        if($contador == count($detalles)) {
            echo 1;
        } else {
            echo 2;
        } */

    }
}