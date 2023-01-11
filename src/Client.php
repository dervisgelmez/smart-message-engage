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

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::API,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 1,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/xml'
            )
        ));
        $output = curl_exec($curl);
        curl_close($curl);

        return $request->getResponse($output);
    }
}