<?php

namespace Elysio\Http;

class Response
{
    private array $headers = [];
    private string $body;

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function addHeaders(array|string $headers): self
    {
        if(is_string($headers))
        {
            $this->headers[] = $headers;
        }
        else
        {
            $this->headers = array_merge($this->headers, $headers);
        }

        return $this;
    }

    /**
     * Don't use unless you know what you're doing!
     */
    public function applyHeaders(): void
    {
        foreach ($this->headers as $header)
        {
            header($header);
        }
    }
}
