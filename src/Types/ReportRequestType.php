<?php

namespace SmartMessageEngage\Types;

use SmartMessageEngage\Client;
use SmartMessageEngage\Requests\ReportRequest;

class ReportRequestType extends Client
{
    /**
     * @var string
     */
    private $messageId;

    public function setMessageId(string $messageId)
    {
        $this->messageId = $messageId;
        return $this;
    }

    public function getMessageId(): string
    {
        return $this->messageId;
    }

    public function execute()
    {
        $request = new ReportRequest($this->app);
        $request->config($this);

        return $this->call($request);
    }
}