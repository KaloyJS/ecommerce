<?php

namespace App\Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mail
{
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer();
        $this->setUp();
    }

    public function setUp()
    {
        //Tell PHPMailer to use SMTP
        $this->mail->isSMTP();

        //Enable SMTP debugging
        //SMTP::DEBUG_OFF = off (for production use)
        //SMTP::DEBUG_CLIENT = client messages
        //SMTP::DEBUG_SERVER = client and server messages
        $environment = $_ENV['APP_ENV'];
        if ($environment === 'localhost') {
            $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
        }
        //Set the hostname of the mail server
        $this->mail->Host = $_ENV['SMTP_HOST'];
        //Use `$this->mail->Host = gethostbyname('smtp.gmail.com');`
        //if your network does not support SMTP over IPv6,
        //though this may cause issues with TLS

        //Set the SMTP port number:
        // - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
        // - 587 for SMTP+STARTTLS
        $this->mail->Port = $_ENV['SMTP_PORT'];

        //Set the encryption mechanism to use:
        // - SMTPS (implicit TLS on port 465) or
        // - STARTTLS (explicit TLS on port 587)
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        //Whether to use SMTP authentication
        $this->mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $this->mail->Username = $_ENV['EMAIL_USERNAME'];

        //Password to use for SMTP authentication
        $this->mail->Password = $_ENV['EMAIL_PASSWORD'];

        $this->mail->isHTML(true);

        $this->mail->setFrom('from@example.com', 'TindihanKo Support');
    }

    public function send($data)
    {

        $this->mail->addAddress('kaloywebdev@gmail.com', 'Kaloy');
        $this->mail->subject = $data['subject'];
        $this->mail->Body = make($data['view'], array('data' => $data['body']));
        return $this->mail->send();
    }
}
