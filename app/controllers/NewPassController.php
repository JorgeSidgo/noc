<?php

class NewPassController extends ControladorBase
{


    public static function reestablecer() {
        self::loadHeadOnly();
        require_once './app/view/Usuario/newPassword.php';
    }


    public function autorizar() {
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
}

?>