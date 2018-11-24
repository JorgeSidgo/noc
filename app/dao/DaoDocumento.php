<?php 

class DaoDocumento extends DaoBase {

    public function __construct() {
        parent::__construct();
        $this->objeto = new Documento();
    }

}