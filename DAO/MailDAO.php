<?php

namespace DAO;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


class MailDAO{


    public function __construct(){}

    public function sendNewMail($email, $msg, $subject)
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'utnjobsok@gmail.com';                     //SMTP username
            $mail->Password   = 'aaalwcmmljzwdyil';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('utnjobsok@gmail.com', 'UTNJobs');
            $mail->addAddress($email);     //Add a recipient

            //Attachments
            /*
            $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            */

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $msg;
            $mail->AltBody = 'alt';

            $mail->send();
            echo 'Message has been sent';
            echo "<script>window.history.go(-1)</script>";
            //header("location:". FRONT_ROOT . "User/showUserProfile");
        } 
        catch (Exception $e) 
        {
            echo "no se envio el mail correctamente.";
        }
    }
}
?>