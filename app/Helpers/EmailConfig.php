<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;

class EmailConfig
{
    static  function config($name, $mensaje): PHPMailer
    {
        $mail = new PHPMailer(true);
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'diegomartinez1996x@gmail.com';
        $mail->Password = 'piqutsbcfdzsrnkp';
        // $mail->Username = 'boostperuatencion@gmail.com';
        // $mail->Password = 'hlabkcttomghufms';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->Subject = '' . $name . ', '.$mensaje. '';
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('info@wolfcarautoradios.com', 'Wolfcar');
        return $mail;
    }
}
