<?php 

class DaoBase {

    protected $con;
    protected $objeto;

    public function __construct() {
        $this->con = new Conexion();
    }

}