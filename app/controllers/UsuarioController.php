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

    public static function contraseñaOlvidada() {
        self::loadHeadOnly();
        require_once './app/view/Usuario/newPassword.php';
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
        session_start();
        session_unset();
        session_destroy();
        header("location: ?");
    }

    public function registrar() {
        $datos = $_REQUEST["datos"];

        $datos = json_decode($datos);

        if(empty($datos->rol)) {
            $rol = 2;
        } else {
            $rol = $datos->rol;
        }

        $dao = new DaoUsuario();

        $dao->objeto->setNombre($datos->nombre);
        $dao->objeto->setApellido($datos->apellido);
        $dao->objeto->setNomUsuario($datos->user);
        $dao->objeto->setEmail($datos->correo);
        $dao->objeto->setPass($datos->pass);
        $dao->objeto->setCodigoRol($rol);
        $dao->objeto->setCodigoArea($datos->area);

        echo $dao->registrar();
     
    }

    public function newPass() {
        //Generador de contraseñas aleatorias
        $psswd = substr( md5(microtime()), 1, 8);

        $dao = new DaoUsuario();

        require './app/mail/MailPassword.php';
        $mail = new Mail();

        $id = $_REQUEST["user"];
        $email = $_REQUEST["email"];

        
        
        $dao->objeto->setNomUser($id);
        $dao->objeto->setEmail($email);

        $datosUsuario = json_decode($dao->cargarDatosUsuario());
        
        if(!$mail->composeAuthMail($datosUsuario, $psswd)) {
            echo "El correo no fue enviado Correctamente";
        }

        echo $dao->reestablecer($psswd);
    }

    public function registrarExterno() {

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
        
        $dao = new DaoUsuario();

        require './app/mail/Mail.php';
        $mail = new Mail();

        $id = $_REQUEST["id"];
        $estado = $_REQUEST["estado"];

        $estadoCuenta = $estado == 1 ? 'Autorizada' : 'Restringida';
        
        $dao->objeto->setCodigoUsuario($id);
        
        $datosUsuario = json_decode($dao->cargarDatosUsuario());
        
        if(!$mail->composeAuthMail($datosUsuario, $estadoCuenta)) {
            echo "El correo no fue enviado Correctamente";
        }

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