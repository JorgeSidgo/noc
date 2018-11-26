<?php 

class DaoArea extends DaoBase {
    
    public function __construct() {
        parent::__construct();
        $this->objeto = new Area();
    }

    public function mostrarAreas() {
        $_query = "select * from area";

        $resultado = $this->con->query($_query);

        $json = '';

        while($fila = $resultado->fetch_assoc()) {
            $json .= json_encode($fila).',';
        }

        $json = substr($json,0, strlen($json) - 1);

        return '['.$json.']';
    }

    public function mostrarAreasDT() {
        $_query = "call mostrarArea()";

        $resultado = $this->con->query($_query);

        $_json = '';

        while($fila = $resultado->fetch_assoc()) {

            $object = json_encode($fila);

            $btnEditar = '<button id=\"'.$fila["codigoArea"].'\" class=\"ui btnEditar icon blue small button\"><i class=\"edit icon\"></i></button>';
            $btnEliminar = '<button id=\"'.$fila["codigoArea"].'\" class=\"ui btnEliminar icon negative small button\"><i class=\"trash icon\"></i></button>';

            $acciones = ', "Acciones": "'.$btnEditar.' '.$btnEliminar.'"';

            $object = substr_replace($object, $acciones, strlen($object) -1, 0);

            $_json .= $object.',';
        }

        $_json = substr($_json,0, strlen($_json) - 1);

        return '{"data": ['.$_json .']}';
    }

    public function registrar() {
        $_query = "call registrarArea('".$this->objeto->getDescArea()."')";

        $resultado = $this->con->query($_query);

        if($resultado) {
            return 1;
        } else {
            return 0;
        }
    }

    public function editar() {
        $_query = "call editarArea('".$this->objeto->getDescArea()."',".$this->objeto->getCodigoArea().")";

        $resultado = $this->con->query($_query);

        if($resultado) {
            return 1;
        } else {
            return 0;
        }
    }

    public function cargarDatosArea() {
        $_query = "select * from area where codigoArea = ".$this->objeto->getCodigoArea();

        $resultado = $this->con->query($_query);

        $json = json_encode($resultado->fetch_assoc());

        return $json;
    }

    public function eliminar() {
        $_query = "delete from area where codigoArea = ".$this->objeto->getCodigoArea();

        $resultado = $this->con->query($_query);

        if($resultado) {
            return 1;
        } else {
            return 0;
        }
    }

}