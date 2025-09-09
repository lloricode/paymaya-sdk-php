<?php

use Lloricode\Paymaya\Paymaya;
use Lloricode\Paymaya\Enums\Environment;
use Saloon\Exceptions\Request\RequestException;

$api = new Paymaya(
    environment: Environment::Sandbox,
    secretKey: "sk-X8qolYjy62kIzEbr0QRK1h4b4KDVHaNcwMYk39jInSl",
    publicKey: "pk-Z0OSzLvIcOI2UIvDhdTGVVfRSSeiGStnceqwUE7n0Ah"
);
try {
    $r = $api->createPayment("dd74de8d-3842-4875-84a1-139ae46d5aba");

    ray($r)->green();
} catch (\Saloon\Exceptions\Request\ClientException $e) {

    ray($e->getResponse()->array())->orange();
}
