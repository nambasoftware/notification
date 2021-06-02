<?php

namespace Notification;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Email {
    
    private $mail = \stdClass::class;
    
    public function __construct($smtpDebug, $host, $user, $pass, $smtpSecure, $port, $setFromEmail, $setFromName) 
    {
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPDebug = $smtpDebug;  //1 - normal ou 2 - Debugar                     
        $this->mail->isSMTP();                                           
        $this->mail->Host       = $host;                    
        $this->mail->SMTPAuth   = true;                                  
        $this->mail->Username   = $user;                    
        $this->mail->Password   = $pass;                              
        $this->mail->SMTPSecure = $smtpSecure;
        $this->mail->Port       = $port;
        $this->mail->CharSet    = 'utf-8';
        $this->mail->setLanguage('br');
        $this->mail->isHTML(true);
        $this->mail->setFrom($setFromEmail, $setFromName);
    }
    
    public function sendMail($subject, $body, $replyEmail, $replyName, $addressEmail, $addressName) 
    {
        $this->mail->Subject = (string)$subject;
        $this->mail->Body = $body;
        
        $this->mail->addReplyTo($replyEmail, $replyName);
        $this->mail->addAddress($addressEmail, $addressName);
        
        try {
            $this->mail->send();
        } catch (Exception $exception) {
            echo "Erro ao enviar o Email:  {$this->mail->ErrorInfo} {$e->getMessage()}";
        }
    }
    
}
