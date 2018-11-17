<?php

class UsuarioController extends ControladorBase {

    // Vistas y otras mierdas

    public static function loginView() {
        self::loadHeadOnly();
        require_once './app/view/Usuario/login.php';
    }

    public static function registroForm() {
        self::loadHeadOnly();
        require_once './app/view/Usuario/registro.php';
    }
    
    public static function dashboard() {
        self::loadMain();
        require_once './app/view/Usuario/dashboard.php';
    }

    public static function gestion() {
        self::loadMain();
        require_once './app/view/Usuario/gestion.php';
    }

    // Métodos 

    public static function login() {
        $datos = $_REQUEST["datos"];

        $datos = json_decode($datos);


        $dao = new DaoUsuario();
        $dao->objeto->setNomUsuario($datos->user);
        $dao->objeto->setPass($datos->pass);
        
        echo $dao->login();
    }

    public function logout() {
        session_destroy();
        header("location: ?");
    }

    public function registrar() {
        $datos = $_REQUEST["datos"];

        $datos = json_decode($datos);

        $dao = new DaoUsuario();

        $dao->objeto->setNombre($datos->nombre);
        $dao->objeto->setApellido($datos->apellido);
        $dao->objeto->setNomUsuario($datos->user);
        $dao->objeto->setEmail($datos->correo);
        $dao->objeto->setPass($datos->pass);
        $dao->objeto->setCodigoRol($datos->rol);

        echo $dao->registrar();
     
    }

    public function editar() {
        $datos = $_REQUEST["datos"];

        $datos = json_decode($datos);

        $dao = new DaoUsuario();

        $dao->objeto->setNombre($datos->nombre);
        $dao->objeto->setApellido($datos->apellido);
        $dao->objeto->setNomUsuario($datos->user);
        $dao->objeto->setEmail($datos->correo);
        $dao->objeto->setCodigoRol($datos->rol);
        $dao->objeto->setCodigoUsuario($datos->idDetalle);

        echo $dao->editar();
     
    }

    public function autorizar() {
        $id = $_REQUEST["id"];
        $estado = $_REQUEST["estado"];

        $dao = new DaoUsuario();

        $dao->objeto->setCodigoUsuario($id);

        echo $dao->autorizar($estado);
    }

    public function cargarDatosUsuario() {
        $id = $_REQUEST["id"];

        $dao = new DaoUsuario();

        $dao->objeto->setCodigoUsuario($id);

        echo $dao->cargarDatosUsuario();
    }

    public function eliminar() {
        $datos = $_REQUEST["id"];

        $dao = new DaoUsuario();

        $dao->objeto->setCodigoUsuario($datos);

        echo $dao->eliminar();
    }

    public function mostrarUsuarios() {
        $dao = new DaoUsuario();

        echo $dao->mostrarUsuarios();
    }
}