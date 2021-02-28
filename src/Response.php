<?php

namespace SmartMessageEngage;

class Response
{
    private $returnCode;

    private $explanation;

    private $data;

    private $xml;

    private $success;

    /**
     * @return mixed
     */
    public function getReturnCode()
    {
        return $this->returnCode;
    }

    /**
     * @param mixed $returnCode
     */
    public function setReturnCode($returnCode): void
    {
        $this->returnCode = $returnCode;
        if ($this->returnCode == 1) {
            $this->success = true;
        }
    }

    /**
     * @return mixed
     */
    public function getExplanation()
    {
        return $this->explanation;
    }

    /**
     * @param mixed $explanation
     */
    public function setExplanation($explanation): void
    {
        $this->explanation = $explanation;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getXml()
    {
        return $this->xml;
    }

    /**
     * @param mixed $xml
     */
    protected function setXml($xml): void
    {
        $this->xml = $xml;
    }

    public function success()
    {
        return $this->success;
    }
}