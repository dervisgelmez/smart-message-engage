<?php

namespace SmartMessageEngage\Requests;

use SmartMessageEngage\SmartMessage;

class TokenRequest extends Helper implements IRequest
{
    private $app;

    public function __construct(SmartMessage $app = null)
    {
        $this->app = $app;
    }

    public function config($config = null)
    {
        // TODO: Implement config() method.
    }

    public function getEndpointName()
    {
        return 'GETTOKEN';
    }

    public function getRequestBody()
    {
        return $this->handleSchema(
    '<web:GETTOKEN>
                    <web:data>
                        <![CDATA[
                        <GETTOKEN>
                             <USR>'.$this->app->getUser().'</USR>
                             <PWD>'.$this->app->getPassword().'</PWD>
                        </GETTOKEN>
                        ]]>
                    </web:data>
                </web:GETTOKEN>'
        );
    }

    public function getResponse($responseBody)
    {
        $response = $this->handleResponse($responseBody, $this->getEndpointName());
        if ($response->success()) {
            $xml = $response->getXml();
            $response->setData($xml->TOKEN);
        }

        return $response;
    }
}