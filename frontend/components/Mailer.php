<?php

namespace frontend\components;


use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use yii\base\Model;


class Mailer extends Model
{

    public $from;
    public $name;
    public $to;
    public $html;
    public $subject;


    public function sendMail()
    {
        $from = $this->from;
        $name = $this->name;
        $subject = $this->subject;
        $to = $this->to;
        $html = $this->html;


        $mail = new PHPMailer(true);

        try {
            //Server settings
//            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'smtp.mail.ru';                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'isxoqjon_7710@mail.ru';                     // SMTP username
            $mail->Password = 'isx.010101';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom($from, $name);
            $mail->addAddress($to);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $html;

            $mail->send();
            return true;
        } catch
        (Exception $e) {
            return false;
        }
    }

    public function setFrom($from)
    {
        $this->from = $from;
    }

    public function setTo($to)
    {
        $this->to = $to;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setHtml($html)
    {
        $this->html = $html;
    }

}