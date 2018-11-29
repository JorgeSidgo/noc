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

        $contador = 0;

        foreach($detalles as $detalle) {
            $dao->objeto->setCodigoTipoTramite($detalle->tramite);
            $dao->objeto->setCodigoCliente($detalle->cliente);
            $dao->objeto->setCodigoTipoDocumento($detalle->tipoDocumento);
            $dao->objeto->setCodigoArea($detalle->area);
            $dao->objeto->setMonto($detalle->monto);
            $dao->objeto->setObservacion($detalle->observaciones);

            if($dao->registrarDetalleEnvio()) {
                $contador++;
            }
        }


        require './app/mail/Mail.php';
        $mail = new Mail();

        if(!$mail->detalleEnvio($codigoEnvio)) {
            echo "El correo no fue enviado Correctamente";
        }

        require './app/notif/Notif.php';
        $notif = new Notif();

        $notif->envioRealizado();

        if($contador == count($detalles)) {
            echo 1;
        } else {
            echo 2;
        }

    }
}