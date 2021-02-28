<?php

namespace SmartMessageEngage\Types;

use SmartMessageEngage\Client;
use SmartMessageEngage\Requests\SmsRequest;

class SmsRequestType extends Client
{
    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $phone;

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function send()
    {
        $request = new SmsRequest($this->app);
        $request->config($this);

        return $this->call($request);
    }
}