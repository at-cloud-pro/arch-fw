<?php

namespace ArchFW\Controller;

use \Exception as ArchFWException;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer 
{
    private $cfg;

    private $mail;

    public function __construct()
    {
        $this->cfg = CONFIG['mailConfig'];

        $this->mail = new PHPMailer();

        $this->loadData();
        // $this->addSingleRecipement($recipementData);
        // $this->sendMail($title, $body);
    }

    private function loadData() 
    {
        $this->mail->isSMTP();
        $this->mail->Host = $this->cfg['host'];
        $this->mail->SMTPAuth = $this->cfg['SMTPAuth'];
        $this->mail->Username = $this->cfg['username'];
        $this->mail->Password = $this->cfg['password'];
        $this->mail->Port = $this->cfg['port'];
        $this->mail->CharSet = 'UTF-8';
        $this->mail->setLanguage($this->cfg['lang'], $this->cfg['langPath']);
    }

    public function addSingleRecipement(aray $recipementData)
    {
        $to = $recipementData['email'];
        $name = $recipementData['to'];

        $this->mail->setFrom($this->cfg['fromMail'], $this->cfg['fromName']);
        $this->mail->addAddress($to, $name);
        $this->mail->addBCC("test@archi-tektur.pl", "kopia");
    }

    public function sendMail(string $title,string $body, bool $isHTML)
    {
        $this->mail->isHTML(true);   
            
        $this->mail->Subject = $title;
        $this->mail->Body = $body;

        return $this->mail->send();
    }


}


