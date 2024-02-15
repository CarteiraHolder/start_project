<?php

namespace App\Apis\BrasilApi;


class BrasilApi
{
    protected string $url = 'https://brasilapi.com.br/api';
    protected string $version = 'v1';
    protected string $method = '';

    protected function setVersion(string $value): self
    {
        $this->version = $value;
        return $this;
    }
    protected function setMethod(string $value): self
    {
        $this->method = $value;
        return $this;
    }

    protected function ApiUrl(string | int $findValue): string
    {
        return "{$this->url}/{$this->method}/{$this->version}/{$findValue}";
    }
}
