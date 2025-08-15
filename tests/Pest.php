<?php

declare(strict_types=1);

use Saloon\Config;

beforeEach(function () {
    Config::preventStrayRequests();
});
