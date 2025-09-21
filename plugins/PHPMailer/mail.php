<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
//$mail = new PHPMailer(true);


class Mail{
    //array = [email, recepients(maybe??), subject, body]
    function sendMail($conf){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $conf['mail_host'];                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $conf['mail_username'];                  //SMTP username
            $mail->Password   = $conf['mail_password'];                     //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = $conf['port'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('mtume2016@gmail.com', 'Mailer');
            //$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
            $mail->addAddress($email);              //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            if(!empty($recepients)){
                foreach($recepients as $recipient){
                    $mail->addCC($recipient);
                }
            }
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = 'Alternative text';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function verifyEmail($conf, $emailTo, $name){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host       = $conf['mail_host'];                       
            $mail->SMTPAuth   = true;                                
            $mail->Username   = $conf['mail_username'];
            $mail->Password   = $conf['mail_password'];
            $mail->SMTPSecure = $conf['mail_secure'];
            $mail->Port       = $conf['port'];
            $mail->setFrom('mtume2016@gmail.com', 'ICS 2.2');
            $mail->addAddress($emailTo);


            //Content
            $mail->isHTML(true);
            $mail->Subject = "Welcome to ICS 2.2! Account Verification";
            $mail->Body    = "Hello " . $name . ",<br><br>" .
                             "You requested an account on ICS 2.2.<br><br>" .
                             "In order to use this account you need to <a href=\"#\">Click here</a> to complete the registration process<br><br>" .
                             "Regards,<br>" .
                             "Systems Admin<br>" .
                             "ICS 2.2";
            $mail->AltBody = "none";

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }



   
    }
