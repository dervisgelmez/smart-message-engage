<?php

namespace SmartMessageEngage;

use SmartMessageEngage\Types\ReportRequestType;
use SmartMessageEngage\Types\SmsRequestType;

class Request
{
    private $app;

    public function __construct(SmartMessage $app)
    {
        $this->app = $app;
    }

    public function sms()
    {
        return new SmsRequestType($this->app);
    }

    public function check()
    {
        return new ReportRequestType($this->app);
    }
}