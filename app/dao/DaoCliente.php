<?php

class DaoCliente extends DaoBase
{

    public function __construct() {
        parent::__construct();
        $this->objeto = new Clientes();
    }


    public function mostrarClientesCmb() {
        $_query = "select * from clientes";

        $resultado = $this->con->query($_query);

        $json = '';

        while($fila = $resultado->fetch_assoc()) {
            $json .= json_encode($fila).',';
        }

        $json = substr($json,0, strlen($json) - 1);

        return '['.$json.']';
    }

    public function mostrarClientes() {
        $_query = "call mostrarClientes()";

        $resultado = $this->con->query($_query);

        $_json = '';

        while($fila = $resultado->fetch_assoc()) {

            $object = json_encode($fila);
            $btnEditar = '<button id=\"'.$fila["codigoCliente"].'\" class=\"ui btnEditar icon blue small button\"><i class=\"edit icon\"></i></button>';
            $btnEliminar = '<button id=\"'.$fila["codigoCliente"].'\" class=\"ui btnEliminar icon negative small button\"><i class=\"trash icon\"></i></button>';

            $acciones = ', "Acciones": "'.$btnEditar.' '.$btnEliminar.'"';

            $object = substr_replace($object, $acciones, strlen($object) -1, 0);

            $_json .= $object.',';
        }

        $_json = substr($_json,0, strlen($_json) - 1);

        echo '{"data": ['.$_json .']}';
    }

    public function registrar() {
        $_query = "call registrarCliente('".$this->objeto->getNombreCliente()."', '".$this->objeto->getDireccion()."','".$this->objeto->getTelefono()."')";

        $resultado = $this->con->query($_query);

        if($resultado) {
            return 1;
        } else {
            return 0;
        }
    }


    public function editar() {
        $_query = "call editarCliente('".$this->objeto->getNombreCliente()."', '".$this->objeto->getDireccion()."','".$this->objeto->getTelefono()."', ".$this->objeto->getCodigoCliente().")";

        $resultado = $this->con->query($_query);

        if($resultado) {
            return 1;
        } else {
            return 0;
        }
    }


    public function cargarDatosCliente() {
        $_query = "select * from clientes where codigoCliente = ".$this->objeto->getCodigoCliente();

        $resultado = $this->con->query($_query);

        $json = json_encode($resultado->fetch_assoc());

        return $json;
    }

    public function eliminar() {
        $_query = "delete from clientes where codigoCliente = ".$this->objeto->getCodigoCliente();

        $resultado = $this->con->query($_query);

        if($resultado) {
            return 1;
        } else {
            return 0;
        }
    }

}

?>