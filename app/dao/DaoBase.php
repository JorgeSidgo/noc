<?php 

class DaoBase {

    protected $con;
    public $objeto;

    public function __construct() {
        $obj = new Conexion();
        $this->con = $obj->conectar();
    }

}