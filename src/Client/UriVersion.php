<?php

namespace Lloricode\Paymaya\Client;

class UriVersion
{
    public int $version = 1;
    public string $uri;

    public function __construct(string $uri, int $version = 1)
    {
        $this->uri = $uri;
        $this->version = $version;
    }
}
