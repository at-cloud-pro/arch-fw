<?php
/**
 * ArchFramework (ArchFW in short) is modern, new, fast and dedicated framework for most my modern projects
 *
 * Visit https://github.com/okbrcz/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 * @category  Framework
 * @package   ArchFW
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT
 * @version   4.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW\Controller;

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

    private function loadData(): void
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

    public function sendMail(string $title, string $body, bool $isHTML)
    {
        $this->mail->isHTML(true);

        $this->mail->Subject = $title;
        $this->mail->Body = $body;

        return $this->mail->send();
    }

}
