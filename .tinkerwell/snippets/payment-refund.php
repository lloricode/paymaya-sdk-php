<?php

use Lloricode\Paymaya\DataTransferObjects\Payment\PaymentRefundDto;
use Lloricode\Paymaya\DataTransferObjects\Payment\PaymentTotalAmountDto;

use Lloricode\Paymaya\Paymaya;
use Lloricode\Paymaya\Enums\Environment;

use Saloon\Exceptions\Request\RequestException;
$api = new Paymaya(
    environment: Environment::Sandbox,
    secretKey: "sk-X8qolYjy62kIzEbr0QRK1h4b4KDVHaNcwMYk39jInSl",
    publicKey: "pk-Z0OSzLvIcOI2UIvDhdTGVVfRSSeiGStnceqwUE7n0Ah"
);
try {
    $r = $api->paymentRefund(
        "8f25422a-12fa-4b4b-9c92-26ea7224ea8e",
        new PaymentRefundDto(
            reason: "Customer requested refund",
            totalAmount: new PaymentTotalAmountDto(amount: 1, currency: "PHP")
        )
    );
    ray($r)->green();
} catch (\Saloon\Exceptions\Request\ClientException $e) {

    ray($e->getResponse()->array())->orange();
//    ray(
//        $e
//            ->getResponse()
//            ->collect("message")
//            ->first() ?? $e->getResponse()->body()
//    )->orange();
}
