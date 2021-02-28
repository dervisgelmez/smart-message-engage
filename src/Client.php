<?php

namespace SmartMessageEngage;

use SmartMessageEngage\Requests\IRequest;
use SmartMessageEngage\Requests\TokenRequest;

class Client
{
    const API = 'http://api.smartmessage-engage.com/Service.asmx?wsdl';

    /**
     * @var SmartMessage
     */
    protected $app;

    /**
     * @var false|string
     */
    private $file;

    /**
     * @var string
     */
    protected $token;

    public function __construct(SmartMessage $app)
    {
        $this->app = $app;
        $this->file = realpath(__DIR__.'/token.ini');
        $this->checkToken();
    }

    protected function auth()
    {
        $response = $this->call(new TokenRequest($this->app));
        if ($response->success()) {
            $this->token = $response->getData();
            $data = 'token='.$this->token."\n".'time='.(string)time();
            file_put_contents($this->file, $data);
        }
    }

    protected function checkToken()
    {
        try {
            $file = parse_ini_file($this->file);
        } catch (\Exception $e) {
            @unlink($this->file);
        }

        if (!isset($file['token']) || !isset($file['time'])) {
            $this->auth();
        }

        $this->token = $file['token'];
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
        curl_setopt($ch, CURLOPT_USERPWD, "username:password");
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml; charset=utf-8", "Content-Length: " . strlen($body)));
        $output = curl_exec($ch);
        curl_close($ch);

        return $request->getResponse($output);
    }
}