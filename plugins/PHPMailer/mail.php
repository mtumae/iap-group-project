<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'vendor/autoload.php';
require_once 'templates/email.php';


class Mail{
    function sendMail($email){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'mtume2016@gmail.com';                  //SMTP username
            $mail->Password   = 'dvvayrkawbggrzlb';                     //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

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
            $mail->Subject = "Here is the subject";
            $mail->Body    = "Test email body";
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
            $mail->Body    = 
            "
            <div style='padding: 20px;  box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.2), 0 2px 20px 0 rgba(0, 0, 0, 0.19);  border-radius: 20px; background-color:#d6dcdc; text-align: center;'>
            <div style='color: #6E5BAA; display: block; font-family: hybrea, proxima-nova, 'helvetica neue', helvetica, arial, geneva, sans-serif; font-size: 32px; font-weight: 200;'>
                <p>Account verification code:</p>
                <h1>{{VERIFICATION_CODE}}</h1>
                <p>This code will expire soon.</p>
            </div>
            </div>
            ";
            $mail->AltBody = "none";

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }



   
    }
