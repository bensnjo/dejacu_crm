<?php
// for use PHP Mailer without composer : 

// ex. Create a folder in root/PHPMAILER
// Put on this folder this 3 files find in "src" 
// folder of the distribution : 
// PHPMailer.php , SMTP.php , Exception.php

// include PHP Mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

include dirname(__DIR__) . '/crm/mailer/src/PHPMailer.php';
include dirname(__DIR__) . '/crm/mailer/src/SMTP.php';
include dirname(__DIR__) . '/crm/mailer/src/Exception.php';

// i made a function 
/*
    *
    * Function send_mail_by_PHPMailer($to, $from, $subject, $message);
    * send a mail by PHPMailer method
    * @Param $to -> mail to send
    * @Param $from -> sender of mail
    * @Param $subject -> suject of mail
    * @Param $message -> html content with datas
    * @Return true if success / Json encoded error message if error 
    * !! need -> classes/Exception.php - classes/PHPMailer.php - classes/SMTP.php
    *
    */
function send_mail_by_PHPMailer($to, $subject, $message)
{

    // SEND MAIL by PHP MAILER
    $from = 'crm@dejavutechkenya.com'; //maill to send from
    //$from = 'qa1/revenue@revenue.go.ke';
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->isSMTP(); // Use SMTP protocol
    //$mail->Host = '192.168.4.1'; // Specify  SMTP server
    //$mail->Host = '10.160.8.17';
    $mail->Host = 'dejavutechkenya.com';
    $mail->Port = '465'; // port of your out server
    $mail->SMTPAuth = true; // Auth. SMTP
    $mail->SMTPAutoTLS = true;
    $mail->Username = 'crm@dejavutechkenya.com';
    $mail->Password = "Yealinkpassword2022";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->setFrom($from); // Mail to send at
    $mail->addAddress($to); // Add sender
    $mail->addReplyTo($from); // Adress to reply
    $mail->isHTML(true); // use HTML message
    $mail->Subject = $subject;
    $mail->Body = $message;
    
    

    // SEND
    if (!$mail->send()) {

        // render error if it is
        $tab = array('error' => 'Mailer Error: ' . $mail->ErrorInfo);
        echo json_encode($tab);
        exit;
    } else {
        // return true if message is send
        
        return true;
    }
}
    /*
    *
    * END send_mail_by_PHPMailer($to, $from, $subject, $message)
    * send a mail by PHPMailer method
    *
    */
  
   
