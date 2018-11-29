<?php 

class DaoEnvio extends DaoBase {

    public function __construct() {
        parent::__construct();
        $this->objeto = new Envio();
    }

    public function encabezadoEnvio() {
        $_query = "call encabezadoEnvio
        ({$this->objeto->getCodigoUsuario()})";

        $resultado = $this->con->ejecutar($_query);

        $resultado = $resultado->fetch_assoc();

        $codigoEnvio = $resultado["codigoEnvio"];

        return $codigoEnvio;
    }


    public function registrarDetalleEnvio() {

        $query = "call registrarDetalleEnvio(".$this->objeto->getCodigoEnvio().", ".$this->objeto->getCodigoTipoTramite().", ".$this->objeto->getCodigoCliente().", ".$this->objeto->getCodigoTipoDocumento().", ".$this->objeto->getCodigoArea().", '".$this->objeto->getMonto()."', '".$this->objeto->getObservacion()."');";

        $resultado = $this->con->ejecutar($query);

        return $resultado; 
    }

    public function getEncabezadoEnvio() {
        $_query = "call getEncabezadoEnvio({$this->objeto->getCodigoEnvio()})";

        $resultado = $this->con->ejecutar($_query);

        return $resultado;
    }

    public function detallesEnvio() {
        $_query = "call detallesEnvio({$this->objeto->getCodigoEnvio()})";

        $resultado = $this->con->ejecutar($_query);

        return $resultado;
    }

    public function mostrarPaquetes()
    {
        $_query = "call mostrarPaquetes()";

        $resultado = $this->con->ejecutar($_query);

        $_json = '';

        while($fila = $resultado->fetch_assoc()) {

            $object = json_encode($fila);
            $btnVer = '<button id=\"'.$fila["codigoEnvio"].'\" class=\"ui btnVer icon blue small button\"><i class=\"eye icon\"></i></button>';

            $acciones = ', "Acciones": "'.$btnVer.'"';

            $object = substr_replace($object, $acciones, strlen($object) -1, 0);

            $_json .= $object.',';
        }

        $_json = substr($_json,0, strlen($_json) - 1);

        echo '{"data": ['.$_json .']}';
    }
}
