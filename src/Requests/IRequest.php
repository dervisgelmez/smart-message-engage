<?php

namespace SmartMessageEngage\Requests;

use SmartMessageEngage\SmartMessage;

interface IRequest
{
    public function __construct(SmartMessage $app = null);
    public function config($config = null);
    public function getEndpointName();
    public function getRequestBody();
    public function getResponse($responseBody);
}