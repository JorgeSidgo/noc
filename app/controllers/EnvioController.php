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

    public function controlEnvios()
    {
        self::loadMain();
        require_once './app/view/Envio/controlEnvios.php';
    }

    public function detallesEnvio()
    {
        self::loadMain();
        require_once './app/view/Envio/detallesEnvio.php';
    }

    public function llamaReporte()
    {
        require_once './app/ReporteDiario/reporteDiario.php';
    }
    

    public function historialEnvios()
    {
        self::loadMain();
        require_once './app/view/Envio/historialEnvios.php';
    }
    // Métodos 

   

    public function mostrarPaquetes()
    {
        $dao = new DaoEnvio();

        echo $dao->mostrarPaquetes();
    }

    public function historialEnviosP()
    {
        $dao = new DaoEnvio();

        echo $dao->historialEnvios();
    }

    public function actualizarDetalle() {
        $dao = new DaoEnvio();

        $detalle = json_decode($_REQUEST["detalle"]);

        $dao->objeto->setCodigoDetalleEnvio($detalle->idDetalle);
        $dao->objeto->setCodigoStatus($detalle->idStatus);
        $dao->objeto->setObservacion($detalle->observacion);

        echo $dao->actualizarDetalle();
        
    }

    public function getDetallesEnvio() {
        $dao = new DaoEnvio();

        $id = $_REQUEST["id"];
        
        $dao->objeto->setCodigoEnvio($id);

        $resultado = $dao->detallesEnvio();

        $json = '';

        while($fila = $resultado->fetch_assoc()) {

            $json .= json_encode($fila).',';

        }

        $json = substr($json, 0, strlen($json) - 1);

        echo'['.$json.']';
    }

    public function getDetallesEnvioH() {
        $dao = new DaoEnvio();

        $id = $_REQUEST["id"];
        
        $dao->objeto->setCodigoEnvio($id);

        $resultado = $dao->detallesEnvioH();

        $json = '';

        while($fila = $resultado->fetch_assoc()) {

            $json .= json_encode($fila).',';

        }

        $json = substr($json, 0, strlen($json) - 1);

        echo'['.$json.']';
    }

    public function getMisEnvios() {
        session_start();
        $dao = new DaoEnvio();

        $dao->objeto->setCodigoUsuario($_SESSION["codigoUsuario"]);

        echo $dao->misEnvios();
    }

    public function misDetallesPendientes() {
        session_start();
        $dao = new DaoEnvio();

        $dao->objeto->setCodigoUsuario($_SESSION["codigoUsuario"]);

        echo $dao->misDetallesPendientes();
    }

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
            $dao->objeto->setNumDoc($detalle->numDocumento);

            if($dao->registrarDetalleEnvio()) {
                $contador++;
            } else {
                echo 'nell';
            }
        }


        require './app/mail/Mail.php';
        $mail = new Mail();

        if(!$mail->detalleEnvio($codigoEnvio)) {
            echo "El correo no fue enviado Correctamente";
        }

        if($contador == count($detalles)) {
            echo 1;
        } else {
            echo 2;
        }

    }

    public function revisionPaquete() {
        session_start();
        
        $idEnvio = $_REQUEST["idEnvio"];
    
        $idUsuario = $_REQUEST["idUsuario"];

        $daoUsuario = new DaoUsuario();

        $daoUsuario->setCodigoUsuario($idUsuario);

        $datosUsuario = json_decode($daoUsuario->cargarDatosUsuario());

        

    }
}