<?php

namespace App\http;

class Request
{
    public function __construct(
        private string $method,
        private string $url,
        private array $query,
        private array $body,
    ) {}

    public function method(): string
    {
        return $this->method;
    }

    public function uri(): string
    {
        return $this->url;
    }

    public function query(): array
    {
        return $this->query;
    }

    public function body(): array
    {
        return $this->body;
    }
}