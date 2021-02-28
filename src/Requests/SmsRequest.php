<?php

namespace SmartMessageEngage\Requests;

use SmartMessageEngage\SmartMessage;
use SmartMessageEngage\Types\SmsRequestType;

class SmsRequest extends Helper implements IRequest
{
    /**
     * @var SmartMessage|null
     */
    private $app;

    /**
     * @var SmsRequestType
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
        return 'SENDSMS';
    }

    public function getRequestBody()
    {
        return $this->handleSchema(
        '<web:SENDSMS>
                        <web:data>
                        <![CDATA[
                            <SENDSMS>
                                <JID>'.$this->app->getJobId().'</JID>
                                <USR>'.$this->app->getUser().'</USR>
                                <PWD>'.$this->app->getPassword().'</PWD>
                                <SBJ>'.$this->config->getSubject().'</SBJ>
                                <MSG>'.$this->config->getMessage().'</MSG>
                                <RCPT_LIST>
                                    <RCPT>
                                        <TA>'.$this->config->getPhone().'</TA>
                                    </RCPT>
                                </RCPT_LIST>
                            </SENDSMS>
                        ]]>
                        </web:data>
                    </web:SENDSMS>'
        );
    }

    public function getResponse($responseBody)
    {
        $response = $this->handleResponse($responseBody, $this->getEndpointName());
        if ($response->success()) {
            $xml = $response->getXml();
            $response->setData($xml->SENDSMSRSP);
        }

        return $response;
    }
}