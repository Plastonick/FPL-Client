<?php

namespace FPL\Transport;

class Curl
{
    /** @var resource cURL handle */
    private $ch;

    /**
     * @param string $url
     * @param array $options
     */
    public function __construct($url, array $options = [])
    {
        $this->ch = curl_init($url);

        foreach ($options as $key => $val) {
            curl_setopt($this->ch, $key, $val);
        }

        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * @return string
     * @throws \RuntimeException On cURL error
     */
    public function getResponse(): string
    {
        $response = curl_exec($this->ch);
        $error = curl_error($this->ch);
        $errno = curl_errno($this->ch);

        if (is_resource($this->ch)) {
            curl_close($this->ch);
        }

        if ($errno !== 0 || $response === false) {
            throw new \RuntimeException($error, $errno);
        }

        return $response;
    }
}
