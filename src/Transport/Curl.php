<?php

namespace FPL\Transport;

use FPL\Exception\TransportException;

class Curl
{
    /** @var resource cURL handle */
    private $ch;

    public function __construct(string $url)
    {
        $this->ch = curl_init($url);

        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * @return string
     * @throws TransportException on curl error
     */
    public function getResponse(): string
    {
        $response = curl_exec($this->ch);
        $error = curl_error($this->ch);
        $errorCode = curl_errno($this->ch);

        if (is_resource($this->ch)) {
            curl_close($this->ch);
        }


        if ($errorCode !== 0 || !is_string($response)) {
            throw new TransportException($error, $errorCode);
        }

        return $response;
    }
}
