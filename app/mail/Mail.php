<?php 

require_once './app/composer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './app/composer/vendor/phpmailer/phpmailer/src/Exception.php';
require './app/composer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './app/composer/vendor/phpmailer/phpmailer/src/SMTP.php';

class Mail {

    public function __construct() {

    }

    public function composeAuthMail($datosUsuario, $estadoCuenta) {

        $emailFrom = 'deloitte.prueba.no.reply@gmail.com';
        $emailFromName = 'Deloitte';

        $emailTo = $datosUsuario->email;
        $emailToName = $datosUsuario->nombre.' '. $datosUsuario->apellido;

        $mail = new PHPMailer();
        $mail->isSMTP();

        require_once './app/encode/Encode.php';

        $encode = new Encode();

        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->isHTML(true);
        // $mail->SMTPDebug = 2;
        $mail->Charset = 'UTF-8';

        $mail->Username = 'deloitte.prueba.no.reply@gmail.com';
        $mail->Password = 'Deloitte123!';
        $mail->setFrom($emailFrom, $emailFromName);

        $mail->addAddress($emailTo, $emailToName);

        $mail->Subject = 'Control de Cuenta Deloitte';

        $plantilla = file_get_contents('./app/mail/correoAuth.html');

        if($estadoCuenta == 'Autorizada') {
            $celda = '<td style="padding: 20px 0px;"><a href="localhost/deloitte-mensajeria/?1=UsuarioController&2=loginView&3='.$encode->encode('e', $datosUsuario->nomUsuario).'" style="padding: 10px; border-radius: 3px; background: #85BC22; text-decoration: none; color: #fff;">Iniciar Sesión</a></td>';
        } else {
            $celda = '<td></td>';
        }

        
        
        $plantilla = str_replace('%estadoCuenta%', $estadoCuenta, $plantilla);
        $plantilla = str_replace('%celda%', $celda, $plantilla);
        
        $mail->Body = $plantilla;
        $mail->AltBody = strip_tags($plantilla);
        // $mail->AltBody(strip_tags($plantilla));
        $mail->AddEmbeddedImage('./app/mail/deloitteNegro.png', 'logo');


        if($mail->Send())
        {
            return true;
        } else {
            return false;
        }
    }

    public function composeRestorePassMail($emailUsuario, $nomUsuario, $pass) {

        $emailFrom = 'deloitte.prueba.no.reply@gmail.com';
        $emailFromName = 'Deloitte';

        $emailTo = $emailUsuario;
        // $emailToName = $datosUsuario->nombre.' '. $datosUsuario->apellido;
        $emailToName = $nomUsuario;

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

        $mail->Subject = 'Control de Cuenta Deloitte';

        $plantilla = file_get_contents('./app/mail/correoRestorePass.html');

        $plantilla = str_replace('%codigoPass%', $pass, $plantilla);

        $mail->msgHTML($plantilla);
        $mail->AddEmbeddedImage('./app/mail/deloitteNegro.png', 'logo');
        
        if($mail->Send())
        {
            return true;
        }
    }

}