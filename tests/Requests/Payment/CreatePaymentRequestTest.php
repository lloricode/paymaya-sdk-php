<?php

declare(strict_types=1);

use Lloricode\Paymaya\Requests\Payment\CreatePaymentRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertSame;

it('create', function () {

    $data = [
        'id' => '042866c3-31ba-45e3-8d9b-76d6553ae283',
        'isPaid' => true,
        'status' => 'PAYMENT_SUCCESS',
        'amount' => '1000.1', // to support float on test
        'currency' => 'PHP',
        'canVoid' => true,
        'canRefund' => false,
        'canCapture' => false,
        'createdAt' => '2025-09-04T04:57:24.217Z',
        'updatedAt' => '2025-09-04T04:58:19.571Z',
        'requestReferenceNumber' => 'reference_id',
        'description' => 'Charge for aa aa',
        'paymentTokenId' => 'fKLoJTS3U1RUq19k73IElGa3...',
        'fundSource' => [
            'type' => 'card',
            'id' => 'fKLoJTS3U1RUq19k73IElGa3s0Su46PesM1tJtke...',
            'description' => '**** **** **** 1522',
            'details' => [
                'scheme' => 'visa',
                'last4' => '1522',
                'first6' => '412345',
                'masked' => '412345******1522',
                'issuer' => 'Others',
            ],
        ],
        'receipt' => [
            'transactionId' => '356707e4-7313-44de-b99e-7f1d154d8100',
            'approvalCode' => '00001234',
            'receiptNo' => '4c9f8acfa3b2',
            'approval_code' => '00001234',
        ],
        'approvalCode' => '00001234',
        'receiptNumber' => '4c9f8acfa3b2',
    ];
    MockClient::global([
        CreatePaymentRequest::class => new MockResponse(
            body: $data,
        ),
    ]);

    $dto = paymaya()->createPayment($data['id']);
    $data['amount'] = (float) $data['amount'];
    assertSame($data, json_decode(json_encode($dto), true));
});

it('create 2', function () {

    $data = [
        'id' => '042866c3-31ba-45e3-8d9b-76d6553ae283',
        'isPaid' => true,
        'status' => 'PAYMENT_SUCCESS',
        'amount' => '1000.1', // to support float on test
        'currency' => 'PHP',
        'canVoid' => true,
        'canRefund' => false,
        'canCapture' => false,
        'createdAt' => '2025-09-04T04:57:24.217Z',
        'updatedAt' => '2025-09-04T04:58:19.571Z',
        'requestReferenceNumber' => 'reference_id',
    ];
    MockClient::global([
        CreatePaymentRequest::class => new MockResponse(
            body: $data,
        ),
    ]);

    $dto = paymaya()->createPayment($data['id']);
    $data['amount'] = (float) $data['amount'];

    assertSame($data, array_filter(
        json_decode(json_encode($dto), true),
        fn ($value) => $value !== null
    ));
});
