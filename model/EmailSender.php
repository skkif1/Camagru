<?php

class EmailSender
{
    private $email;
    private $subject;
    private $message;
    private $headers;


    public function __construct($email, $subject, $message)
    {
        $this->headers  = 'MIME-Version: 1.0' . "\r\n";
        $this->headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $this->subject = $subject;
        $this->message = $message;
        $this->email = $email;
    }

    public function sendEmail()
    {
        if (mail($this->email, $this->subject, $this->message, $this->headers))
            return 1;
        return 0;
    }
}