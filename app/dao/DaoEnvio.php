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

    public function actualizarDetalle() {
        $_query = "call actualizarDetalle({$this->objeto->getCodigoDetalleEnvio()}, {$this->objeto->getCodigoStatus()}, '{$this->objeto->getObservacion()}')";

        $resultado = $this->con->ejecutar($_query);

        if($resultado) {
            return 1;
        } else {
            return 0;
        }
    }

    public function registrarDetalleEnvio() {

        $query = "call registrarDetalleEnvio(".$this->objeto->getCodigoEnvio().", ".$this->objeto->getCodigoTipoTramite().", ".$this->objeto->getCodigoCliente().", ".$this->objeto->getCodigoTipoDocumento().", ".$this->objeto->getCodigoArea().", '".$this->objeto->getMonto()."', '".$this->objeto->getObservacion()."', '".$this->objeto->getNumDoc()."');";

        $resultado = $this->con->ejecutar($query);

        return $resultado;
    }

    public function getEncabezadoEnvio() {
        $_query = "call getEncabezadoEnvio({$this->objeto->getCodigoEnvio()})";

        $resultado = $this->con->ejecutar($_query);

        return $resultado;
    }

    public function detallesEnvio() {
        $_query = "call detallesEnvioH({$this->objeto->getCodigoEnvio()})";

        $resultado = $this->con->ejecutar($_query);

        return $resultado;
    }

    public function detallesEnvioH() {
        $_query = "call detallesEnvioH({$this->objeto->getCodigoEnvio()})";

        $resultado = $this->con->ejecutar($_query);

        return $resultado;
    }

    public function misEnvios() {
        $_query = "call misEnvios({$this->objeto->getCodigoUsuario()})";

        $resultado = $this->con->ejecutar($_query);

        $_json = '';

        $contador_pendientes = 0;
        $contador_completo = 0;
        $contador_revisado = 0;
        $contador_finanzas = 0;


        while($fila = $resultado->fetch_assoc()) {

            $btnVer = '<button id=\"'.$fila["codigoEnvio"].'\" class=\"ui btnVer icon secondary small button\"><i class=\"list ul icon\"></i></button>';

            $sub_query = "call detallesEnvioLabel({$fila["codigoEnvio"]})";

            $sub_resultado = $this->con->ejecutar($sub_query);


            while($sub_fila = $sub_resultado->fetch_assoc()) {

                switch($sub_fila["descStatus"]) {
                    case 'Pendiente':
                        $contador_pendientes++;
                        break;

                    case 'Revisado':
                        $contador_revisado++;
                        break;

                    case 'Completo':
                        $contador_completo++;
                        break;

                    case 'Regresado a Finanzas':
                    $contador_finanzas++;
                    break;
                }
            }

            $label_pendientes= '<a class=\"ui yellow label\">'.$contador_pendientes.'</a>';
            $label_completo= '<a class=\"ui green label\">'.$contador_completo.'</a>';
            $label_revisado= '<a class=\"ui orange label\">'.$contador_revisado.'</a>';
            $label_finanzas= '<a class=\"ui blue label\">'.$contador_finanzas.'</a>';

            $labels = '<div class=\"ui small labels\">'.$label_pendientes.$label_completo.$label_revisado.$label_finanzas.'</div>';

            $object = '{
                            "codigoEnvio": "'.$fila["codigoEnvio"].'",
                            "fecha": "'.$fila["fecha"].'",
                            "hora": "'.$fila["hora"].'",
                            "documentos": "'.$labels.'",
                            "Acciones": "'.$btnVer.'"
                        }';

            $_json .= $object.',';


            $contador_pendientes = 0;
            $contador_completo = 0;
            $contador_revisado = 0;
            $contador_finanzas = 0;
        }

        $_json = substr($_json,0, strlen($_json) - 1);

        echo '{"data": ['.$_json .']}';
    }

    public function misDetallesPendientes() {
        $_query = "call misDocumentosPendientes({$this->objeto->getCodigoUsuario()})";

        $resultado = $this->con->ejecutar($_query);

        $_json = '';

        while($fila = $resultado->fetch_assoc()) {
            $_json .=  json_encode($fila).',';
        }

        $_json = substr($_json,0, strlen($_json) - 1);


        return '['.$_json.']';
    }

    public function mostrarPaquetes()
    {
        $_query = "call mostrarPaquetes()";

        $resultado = $this->con->ejecutar($_query);

        $_json = '';

        $contador_pendientes = 0;
        $contador_completo = 0;
        $contador_recibido = 0;
        $contador_revisado = 0;
        $contador_finanzas = 0;


        while($fila = $resultado->fetch_assoc()) {

            $btnVer = '<button id=\"'.$fila["codigoEnvio"].'\" class=\"ui btnVer icon secondary small button\"><i class=\"list ul icon\"></i></button>';
            $btnCorreo = '<button codigo-usuario=\"'.$fila["codigoUsuario"].'\" codigo-envio=\"'.$fila["codigoEnvio"].'\" class=\"ui btnCorreo icon teal small button\"><i class=\"check icon\"></i></button>';

            $sub_query = "call detallesEnvioLabel({$fila["codigoEnvio"]})";

            $sub_resultado = $this->con->ejecutar($sub_query);


            while($sub_fila = $sub_resultado->fetch_assoc()) {

                switch($sub_fila["descStatus"]) {
                    case 'Pendiente':
                        $contador_pendientes++;
                        break;

                    case 'Revisado':
                        $contador_revisado++;
                        break;
                    
                    case 'Recibido':
                        $contador_revisado++;
                        break;

                    case 'Completo':
                        $contador_completo++;
                        break;

                    case 'Regresado a Finanzas':
                    $contador_finanzas++;
                    break;
                }
            }

            $label_pendientes= '<a class=\"ui yellow label\">'.$contador_pendientes.'</a>';
            $label_completo= '<a class=\"ui green label\">'.$contador_completo.'</a>';
            $label_revisado= '<a class=\"ui orange label\">'.$contador_revisado.'</a>';
            $label_recibido= '<a class=\"ui blue label\">'.$contador_recibido.'</a>';
            $label_finanzas= '<a class=\"ui grey label\">'.$contador_finanzas.'</a>';

            $labels = '<div class=\"ui small labels\">'.$label_completo.$label_recibido.$label_revisado.$label_finanzas.$label_pendientes.'</div>';

            $object = '{
                            "codigoEnvio": "'.$fila["codigoEnvio"].'",
                            "correlativoEnvio": "'.$fila["correlativoEnvio"].'",
                            "fecha": "'.$fila["fecha"].'",
                            "hora": "'.$fila["hora"].'",
                            "nomUsuario": "'.$fila["nomUsuario"].'",
                            "nombre": "'.$fila["nombre"].' '.$fila["apellido"].'",
                            "documentos": "'.$labels.'",
                            "Acciones": "'.$btnCorreo.' '.$btnVer.'"
                        }';

            $_json .= $object.',';


            $contador_pendientes = 0;
            $contador_completo = 0;
            $contador_revisado = 0;
            $contador_finanzas = 0;
        }

        $_json = substr($_json,0, strlen($_json) - 1);

        echo '{"data": ['.$_json .']}';
    }

    public function cambiarEnvio($estado) {
        $_query = "update envio set estado = {$estado} where codigoEnvio = {$this->objeto->getCodigoEnvio()}";

        $resultado = $this->con->ejecutar($_query);

        return $resultado;
    }

    public function historialEnvios()
    {
        $_query = "call historialEnvios()";

        $resultado = $this->con->ejecutar($_query);

        $_json = '';

        $contador_pendientes = 0;
        $contador_completo = 0;
        $contador_revisado = 0;
        $contador_finanzas = 0;


        while($fila = $resultado->fetch_assoc()) {

            $btnVer = '<button id=\"'.$fila["codigoEnvio"].'\" class=\"ui btnVer icon secondary small button\"><i class=\"list ul icon\"></i></button>';

            $sub_query = "call detallesEnvioLabel({$fila["codigoEnvio"]})";

            $sub_resultado = $this->con->ejecutar($sub_query);


            while($sub_fila = $sub_resultado->fetch_assoc()) {

                switch($sub_fila["descStatus"]) {
                    case 'Pendiente':
                        $contador_pendientes++;
                        break;

                    case 'Revisado':
                        $contador_revisado++;
                        break;

                    case 'Completo':
                        $contador_completo++;
                        break;

                    case 'Regresado a Finanzas':
                    $contador_finanzas++;
                    break;
                }
            }

            $label_pendientes= '<a class=\"ui yellow label\">'.$contador_pendientes.'</a>';
            $label_completo= '<a class=\"ui green label\">'.$contador_completo.'</a>';
            $label_revisado= '<a class=\"ui orange label\">'.$contador_revisado.'</a>';
            $label_finanzas= '<a class=\"ui blue label\">'.$contador_finanzas.'</a>';

            $labels = '<div class=\"ui small labels\">'.$label_pendientes.$label_completo.$label_revisado.$label_finanzas.'</div>';

            $object = '{
                            "codigoEnvio": "'.$fila["codigoEnvio"].'",
                            "fecha": "'.$fila["fecha"].'",
                            "hora": "'.$fila["hora"].'",
                            "nomUsuario": "'.$fila["nomUsuario"].'",
                            "nombre": "'.$fila["nombre"].' '.$fila["apellido"].'",
                            "documentos": "'.$labels.'",
                            "Acciones": "'.$btnVer.'"
                        }';

            $_json .= $object.',';


            $contador_pendientes = 0;
            $contador_completo = 0;
            $contador_revisado = 0;
            $contador_finanzas = 0;
        }

        $_json = substr($_json,0, strlen($_json) - 1);

        echo '{"data": ['.$_json .']}';
    }


    public function reporteFechas() {
        $query = "call reporteFechas('{$this->objeto->getFecha()}','{$this->objeto->getFecha2()}')";

        $resultado = $this->con->ejecutar($query);

        return $resultado;
    }
}
