<?php

class MailSender
{
    protected $emailAddress;
    protected $subject;
    protected $headers;
    protected $message;

    public function __construct($emailAddress = '', $subject = '', $headers = '', $message = '')
    {
        $this->emailAddress = $emailAddress;
        $this->subject = $subject;
        $this->headers = $headers;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param string $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }


    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }


    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function sendMessage()
    {
        return mail($this->emailAddress, $this->subject, $this->message, $this->headers);
    }
}