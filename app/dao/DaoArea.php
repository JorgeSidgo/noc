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

    public function mostarAreasDT() {

    }

}