<?php

declare(strict_types=1);

use Saloon\Config;
use Saloon\Http\Faking\MockClient;

uses()
    ->beforeEach(function () {
        Config::preventStrayRequests();
        MockClient::destroyGlobal();
    })
    ->in(__DIR__);
