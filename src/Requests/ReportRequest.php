<?php

namespace SmartMessageEngage\Requests;

use SmartMessageEngage\SmartMessage;
use SmartMessageEngage\Types\ReportRequestType;

class ReportRequest extends Helper implements IRequest
{
    /**
     * @var SmartMessage|null
     */
    private $app;

    /**
     * @var ReportRequestType
     */
    private $config;

    public function __construct(SmartMessage $app = null)
    {
        $this->app = $app;
    }

    public function config($config = null)
    {
        $this->config = $config;
    }

    public function getEndpointName()
    {
        return 'GETREPORT';
    }

    public function getRequestBody()
    {
        return $this->handleSchema(
            '<web:GETREPORT>
                        <web:data>
                        <![CDATA[
                            <GETREPORT>
                                <JID>'.$this->app->getJobId().'</JID>
                                <USR>'.$this->app->getUser().'</USR>
                                <PWD>'.$this->app->getPassword().'</PWD>
                                <MSGLIST>
                                    <MSGID>'.$this->config->getMessageId().'</MSGID>
                                </MSGLIST>
                            </GETREPORT>
                        ]]>
                        </web:data>
                    </web:GETREPORT>'
        );
    }

    public function getResponse($responseBody)
    {
        $response = $this->handleResponse($responseBody, $this->getEndpointName());
        if ($response->success()) {
            $xml = $response->getXml();
            $response->setData($xml->RSP_LIST->RSP);
        }

        return $response;
    }
}