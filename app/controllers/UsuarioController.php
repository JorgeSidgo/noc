<?php

class UsuarioController extends ControladorBase {

    // Vistas

    public static function loginView() {
        self::loadHeadOnly();
        require_once './app/view/Usuario/login.php';
    }

    public static function registroForm() {
        self::loadHeadOnly();
        $dao = new DaoArea();
        $areas = $dao->mostrarAreas();
        require_once './app/view/Usuario/registro.php';
    }

    public static function dashboard() {
        self::loadMain();
        $daoU = new DaoUsuario();
        $usuariosCMB = $daoU->mostrarUsuariosCmb();

        $daoA = new DaoArea();
        $areas = $daoA->mostrarAreas();
        require_once './app/view/Usuario/dashboard.php';
    }

    public static function gestion() {
        self::loadMain();
        $dao = new DaoArea();
        $areas = $dao->mostrarAreas();
        require_once './app/view/Usuario/gestion.php';
    }

    public static function contraOlvidada() {
        self::loadHeadOnly();
        require_once './app/view/Usuario/newPassword.php';
    }

    public static function resetPasswordView() {
        self::loadHeadOnly();
        require_once './app/view/Usuario/resetPassword.php';
    }

    public static function config() {
        self::loadMain();
        require_once './app/view/Usuario/config.php';
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

    public function encodeString() {
        $enc = new Encode();

        $encoded = $enc->encode('e', $_REQUEST["string"]);

        echo $encoded;
    }

    public function resetPassword() {

        $enc = new Encode();

        $datos = json_decode($_REQUEST["datos"]);
        $nomUser = $enc->encode('d', $_REQUEST["user"]);

        $dao = new DaoUsuario();

        $dao->objeto->setPass($datos->pass);
        $dao->objeto->setNomUsuario($nomUser);

        echo $dao->resetPassword($datos->code);
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

        require './app/mail/Mail.php';
        $mail = new Mail();

        $datos = json_decode($_REQUEST["datos"]);

        $id = $datos->user;
        $email = $datos->correo;



        $dao->objeto->setNomUsuario($id);
        $dao->objeto->setEmail($email);

        //$datosUsuario = json_decode($dao->cargarDatosUsuario());

        if(!$mail->composeRestorePassMail($email, $id, $psswd)) {
            echo "El correo no fue enviado Correctamente";
        }

        echo $dao->reestablecer($psswd);
    }

    public function registrarExterno() {

    }

    public function reestablecerContra()
    {
        $dao = new DaoUsuario();

        $id = $_REQUEST["id"];
        $nuPass = $_REQUEST["nuPass"];

        $dao->objeto->setPass($nuPass);
        $dao->objeto->setCodigoUsuario($id);
        echo $dao->restablecerContraConfig();
    }

    public function actualizarDatosPersonales()
    {
        $dao = new DaoUsuario();

        $id = $_REQUEST["id"];
        $nomUser = $_REQUEST["nom"];
        $ape = $_REQUEST["ape"];

        $dao->objeto->setNombre($nomUser);
        $dao->objeto->setApellido($ape);
        $dao->objeto->setCodigoUsuario($id);
        echo $dao->cambiarDatos();
    }

    public function eliminarCuenta() {
        $dao = new DaoUsuario();

        $id = $_REQUEST["id"];
        $dao->objeto->setCodigoUsuario($id);
        echo $dao->eliminarCuenta();
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
        $dao->objeto->setCodigoArea($datos->area);
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

    // Reportes 


    public function reporteArea() {
        $daoArea = new DaoArea();
        
        require_once './app/reportes/ReporteArea.php';
        
        $idArea = $_REQUEST["area"];

        $reporte = new Reporte();


        $daoArea->objeto->setCodigoArea($idArea);
        $resultado = $daoArea->reporteArea();
        $resultado1 = $daoArea->reporteArea();

        $reporte->reporteArea($idArea, $resultado, $resultado1);
    }

    public function reporteUsuario() {
        $daoUsuario = new DaoUsuario();
        
        require_once './app/reportes/ReporteUsuario.php';
        
        $idUsuario = $_REQUEST["usuario"];

        $reporte = new Reporte();


        $daoUsuario->objeto->setCodigoUsuario($idUsuario);
        $resultado = $daoUsuario->reporteUsuario();
        $resultado1 = $daoUsuario->reporteUsuario();

        $reporte->reporteUsuario($idUsuario, $resultado, $resultado1);
    }


    public function reporteFechas() {
        $daoEnvio = new DaoEnvio();
        
        require_once './app/reportes/ReporteFechas.php';
        
        $fecha = $_REQUEST["fecha"];
        $fecha2 = $_REQUEST["fecha2"];

        $reporte = new Reporte();


        $daoEnvio->objeto->setFecha($fecha);
       $daoEnvio->objeto->setFecha2($fecha2);
        $resultado = $daoEnvio->reporteFechas();
        $resultado1 = $daoEnvio->reporteFechas();

        $reporte->reporteFechas($fecha,$fecha2, $resultado, $resultado1);
    }
}
