<?php

namespace SmartMessageEngage;

use SmartMessageEngage\Requests\IRequest;

class Client
{
    const API = 'http://api.smartmessage-engage.com/Service.asmx';

    /**
     * @var SmartMessage
     */
    protected $app;

    public function __construct(SmartMessage $app)
    {
        $this->app = $app;
    }

    /**
     * @param IRequest $request
     * @return Response
     */
    protected function call(IRequest $request)
    {
        $body = $request->getRequestBody();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::API);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml; charset=utf-8", "Content-Length: " . strlen($body)));
        $output = curl_exec($ch);
        curl_close($ch);

        return $request->getResponse($output);
    }
}