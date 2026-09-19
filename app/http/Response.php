<?php

namespace App\http;

use CurlHandle;
use Src\Cache;

class Response
{
    public CurlHandle $ch;
    public ?int $statusCode;

    public function __construct(
        public ?array $header,
        public string $url
        ) {
            $this->ch = curl_init();
            $this->statusCode = null;
        }

    public function send(): array
    {
        $this->setCurlOpt();
        $events = json_decode(curl_exec($this->ch));
        $statusCode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

        return [
            "events" => $events,
            "status_code" => $statusCode
        ];
    }

    private function setCurlOpt(): void
    {
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->header);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
    }

    public function __destruct()
    {
        curl_close($this->ch);
    }
}