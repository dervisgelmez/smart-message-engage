<?php

namespace SmartMessageEngage\Requests;

use SmartMessageEngage\Response;

class Helper extends Response
{
    protected function handleSchema($requestBody)
    {
        return
            '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:web="http://odc.com.tr/webservices">
               <soap:Header/>
               <soap:Body>
                '.$requestBody.'
               </soap:Body>
            </soap:Envelope>';
    }

    protected function handleResponse($responseBody, $endPointName)
    {
        $responseKey = $endPointName.'Response';
        $resultKey = $endPointName.'Result';

        $xmlDocument = simplexml_load_string($responseBody);
        $xmlCleaning = str_ireplace(['SOAP-ENV:', 'SOAP:'], '', $xmlDocument->asXML());
        $xml = simplexml_load_string($xmlCleaning);

        $xmlResult =  simplexml_load_string($xml->Body->$responseKey->$resultKey[0]);

        $response = new Response();
        $response->setXml($xmlResult);
        $response->setReturnCode($xmlResult->RTCD);
        $response->setExplanation($xmlResult->EXP);

        return $response;
    }
}