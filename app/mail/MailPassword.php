<?php 

require_once './app/composer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './app/composer/vendor/phpmailer/phpmailer/src/Exception.php';
require './app/composer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './app/composer/vendor/phpmailer/phpmailer/src/SMTP.php';

class MailPassword
{


    public function __construct() {

    }

    public function composeAuthMail($datosUsuario, $pass) {

        $emailFrom = 'deloitte.prueba.no.reply@gmail.com';
        $emailFromName = 'Deloitte';

        $emailTo = $datosUsuario->email;
        $emailToName = $datosUsuario->nombre.' '. $datosUsuario->apellido;

        $mail = new PHPMailer();
        $mail->isSMTP();

        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->isHTML(true);
        $mail->Charset = 'UTF-8';

        $mail->Username = 'deloitte.prueba.no.reply@gmail.com';
        $mail->Password = 'Deloitte123!';
        $mail->setFrom($emailFrom, $emailFromName);

        $mail->addAddress($emailTo, $emailToName);

        $mail->Subject = 'Reestablecer contraseña Deloitte';

       



        //$mail->Body = '<img src="cid:logo"><br/><a style="padding:15px; color: #fff; text-decoration: none; background:#85BC22; border-radius: 5px !important;" href="localhost/deloitte-mensajeria/?">Iniciar Sesión</a>';
        $mail->Body = '<img src="cid:logo"> <a style="padding:15px; color: #fff; text-decoration: none; background:#85BC22; border-radius: 5px !important;" href="localhost/deloitte-mensajeria/?1=UsuarioController&2=loginView&user='.$datosUsuario->nomUsuario.'">Iniciar Sesión</a> <br><br>Su nueva contraseña es: '.$pass;;
        $mail->AddEmbeddedImage('../../res/img/deloiteNegro.png', 'logo');
        
        if($mail->Send())
        {
            return true;
        }
    }

}
?>