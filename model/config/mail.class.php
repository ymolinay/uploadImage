<?php

require_once __DIR__.'/../../files/dll/PHPMailer/class.phpmailer.php';

class Mail {

    private $Mailer;
    private $Host;
    private $SMTPAuth;
    private $Port;
    private $Username;
    private $Password;
    private $AddBCC;
    private $Timeout;
    private $isHTML;
    private $CharSet;
    //
    private $from;
    private $fromName;
    private $subject;
    private $body;
    private $altBody;
    private $to;
    private $toName;
    private $copy;
    private $copyName;

    function __construct($_subject, $_body, $_altBody, $_to, $_toName='', $_copy = '', $_copyName = '') {
        $this->subject = $_subject;
        $this->body = $_body;
        $this->altBody = $_altBody;
        $this->to = $_to;
        $this->toName = $_toName;
        $this->copy = $_copy;
        $this->copyName = $_copyName;
        $this->InitializeMail();
    }

    public function InitializeMail() {
        $this->Mailer = "smtp";
        $this->Host = "smtp.911itg.com";
        $this->SMTPAuth = true;
        $this->Port = 587;
        $this->Username = "desarrollo@911itg.com";
        $this->Password = "Desarrollo2011";
        $this->AddBCC = "desarrollo@911itg.com";
        $this->Timeout = 30;
        $this->isHTML = true;
        $this->from = "Catolica-no-reply@911itg.com";
        $this->fromName = "Catolica";
        $this->CharSet = "UTF-8";
    }

    public function SendMail($objMail) {
        $mailer = $objMail->getMailer();
        $host = $objMail->getHost();
        $smtpAuth = $objMail->getSMTPAuth();
        $port = $objMail->getPort();
        $userName = $objMail->getUsername();
        $password = $objMail->getPassword();
        $addBcc = $objMail->getAddBCC();
        $timeOut = $objMail->getTimeout();
        $isHtml = $objMail->getIsHTML();
        $from = $objMail->getFrom();
        $fromName = $objMail->getFromName();
        $charSet = $objMail->getCharSet();
        //
        $subject = $objMail->getSubject();
        $body = $objMail->getBody();
        $altBody = $objMail->getAltBody();
        //
        $to = explode(';', $objMail->getTo());
        $toName = explode(';', $objMail->getToName());
        //
        $copy = explode(';', $objMail->getCopy());
        $copyName = explode(';', $objMail->getCopyName());

        $mail = new PHPMailer(true);
        try {
            $mail->Mailer = $mailer;
            $mail->Host = $host;
            $mail->SMTPAuth = $smtpAuth;
            $mail->Port = $port;
            $mail->Username = $userName;
            $mail->Password = $password;
            $mail->AddBCC($addBcc);
            $mail->Timeout = $timeOut;
            $mail->isHTML($isHtml);
            $mail->From = $from;
            $mail->FromName = $fromName;
            //
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = $altBody;
            //
            $mail->CharSet = $charSet;
            foreach ($to as $key => $val) {
                if(filter_var($val,FILTER_VALIDATE_EMAIL)){
                    $mail->addAddress($val, $toName[$key]);
                }
            }
            //
            foreach ($copy as $key => $val) {
                if(filter_var($val,FILTER_VALIDATE_EMAIL)){
                    $mail->addCC($val, $copyName[$key]);
                }
            }
            //
            $mail->send();
            return true;
        } catch (phpmailerException $e) {
            return $e->errorMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getMailer() {
        return $this->Mailer;
    }

    public function getHost() {
        return $this->Host;
    }

    public function getSMTPAuth() {
        return $this->SMTPAuth;
    }

    public function getPort() {
        return $this->Port;
    }

    public function getUsername() {
        return $this->Username;
    }

    public function getPassword() {
        return $this->Password;
    }

    public function getAddBCC() {
        return $this->AddBCC;
    }

    public function getTimeout() {
        return $this->Timeout;
    }

    public function getIsHTML() {
        return $this->isHTML;
    }

    public function getCharSet() {
        return $this->CharSet;
    }

    public function getFrom() {
        return $this->from;
    }

    public function getFromName() {
        return $this->fromName;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getBody() {
        return $this->body;
    }

    public function getAltBody() {
        return $this->altBody;
    }

    public function getTo() {
        return $this->to;
    }

    public function getToName() {
        return $this->toName;
    }

    public function getCopy() {
        return $this->copy;
    }

    public function getCopyName() {
        return $this->copyName;
    }

    public function setMailer($Mailer) {
        $this->Mailer = $Mailer;
    }

    public function setHost($Host) {
        $this->Host = $Host;
    }

    public function setSMTPAuth($SMTPAuth) {
        $this->SMTPAuth = $SMTPAuth;
    }

    public function setPort($Port) {
        $this->Port = $Port;
    }

    public function setUsername($Username) {
        $this->Username = $Username;
    }

    public function setPassword($Password) {
        $this->Password = $Password;
    }

    public function setAddBCC($AddBCC) {
        $this->AddBCC = $AddBCC;
    }

    public function setTimeout($Timeout) {
        $this->Timeout = $Timeout;
    }

    public function setIsHTML($isHTML) {
        $this->isHTML = $isHTML;
    }

    public function setCharSet($CharSet) {
        $this->CharSet = $CharSet;
    }

    public function setFrom($from) {
        $this->from = $from;
    }

    public function setFromName($fromName) {
        $this->fromName = $fromName;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function setAltBody($altBody) {
        $this->altBody = $altBody;
    }

    public function setTo($to) {
        $this->to = $to;
    }

    public function setToName($toName) {
        $this->toName = $toName;
    }

    public function setCopy($copy) {
        $this->copy = $copy;
    }

    public function setCopyName($copyName) {
        $this->copyName = $copyName;
    }



}

////new Mail('asunto*','<p>Cuerpo del mensaje en HTML</p>*','Cuerpo del mensaje sin HTML*','direcciones de destinatarios separados por ;*','nombres de destinatarios separados por ;','direcciónes de quienes se les va a copiar separados por ;','nombres de quienes se les vas a copiar separados por ;');
//
////enviar a dos correos
//$objPruebas = new Mail('pruebas', '<p>pruebas con tíldes y eñes</p>', 'no html, pruebas', 'ymolina@911itg.com;yrvingmolina@outlook.com');
//echo $objPruebas->SendMail($objPruebas);
////*****************************************//
////enviar a dos correos adjuntando sus nombres
//$objPruebas = new Mail('pruebas', '<p>pruebas con validación</p>', 'no html, pruebas', 'ymolina@911itg.com;yrvingmolina@outlook.com','Yrving Molina; Heysen Molina');
//echo $objPruebas->SendMail($objPruebas);
////*****************************************//
////enviar a dos correos copiando a otro
//$objPruebas = new Mail('pruebas', '<p>pruebas con validación</p>', 'no html, pruebas', 'ymolina@911itg.com;yrvingmolina@outlook.com','Yrving Molina; Heysen Molina','sistemas@911itg.com','Sistemas');
//echo $objPruebas->SendMail($objPruebas);