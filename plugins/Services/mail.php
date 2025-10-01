<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'vendor/autoload.php';
// require_once 'templates/email.php';
// require_once 'forms/forms.php';
$form = new Forms();



class Mail{
    function verifyAccount($email, $code){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                  //Enable SMTP authentication
            $mail->Username   = 'indradamenace@gmail.com';                  //SMTP username
            $mail->Password   = 'fpbymeevckombqnt';                     //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('mtume2016@gmail.com', 'StudentMarketplace');
            //$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
            $mail->addAddress($email);              //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // if(!empty($recepients)){
            //     foreach($recepients as $recipient){
            //         $mail->addCC($recipient);
            //     }
            // }
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "2 Factor Verification Code";
            $mail->Body    = "
            <div style='padding: 20px;  box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.2), 0 2px 20px 0 rgba(0, 0, 0, 0.19);  border-radius: 20px; background-color:#d6dcdc; text-align: center;'>
                <div style='color: #6E5BAA; display: block; font-family: hybrea, proxima-nova, 'helvetica neue', helvetica, arial, geneva, sans-serif; font-size: 32px; font-weight: 200;'>
                    <p>Account verification code:</p>
                    <h1>".$code."</h1>
                    <p>This code will expire soon.</p>
                </div>
            </div>";
            $mail->AltBody = 'Alternative text';

            $mail->send();
            echo '<p>Message has been sent</p>';
        } catch (Exception $e) {
            echo "<p style='color: red;'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</p>";
        }
    }

    



   
    }
