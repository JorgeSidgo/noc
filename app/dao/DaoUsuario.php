<?php 

class DaoUsuario extends DaoBase {

    public function __construct() {
        parent::__construct();
        $this->objeto = new Usuario();
    }


    public function login() {
        $_query = "select * from usuario where nomUsuario = ? and pass = ?";

        $_params = [$this->objeto->getNomUsuario(), $this->objeto->getPass()];

        $this->con->query($_query, $_params);
        
    }

}