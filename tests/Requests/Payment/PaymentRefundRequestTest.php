<?php

declare(strict_types=1);

use Lloricode\Paymaya\DataTransferObjects\Payment\PaymentRefundDto;
use Lloricode\Paymaya\DataTransferObjects\Payment\PaymentTotalAmountDto;
use Lloricode\Paymaya\Requests\Payment\PaymentRefundRequest;
use Lloricode\Paymaya\Response\Payment\Refund\RefundPayment200Response;
use Lloricode\Paymaya\Response\Payment\Refund\RefundPayment202Response;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertSame;

it('refund', function () {

    $data = [
        'paymentTransactionReferenceNo' => '02c8edb3-301a-4ce6-a8b2-cbcf37dbd5b5',
        'status' => 'SUCCESS',
        'createdAt' => '2025-09-04T02:00:12.344Z',
        'receipt' => [
            'transactionId' => '01234567ABCD',
            'approvalCode' => 119,
            'batchNo' => 20170601,
            'traceNo' => 1,
            'receiptNo' => 805322262599,
        ],
        'refundTransactionReferenceNo' => '69b5e571-7d44-4409-9359-ff93555a65a3',
        'transactionAmount' => [
            'value' => 10.5,
            'currency' => 'PHP',
        ],
        'refundedAmount' => [
            'value' => 10.5,
            'currency' => 'PHP',
        ],
    ];
    MockClient::global([
        PaymentRefundRequest::class => new MockResponse(
            body: $data,
            status: 200,
        ),
    ]);

    $dto = paymaya()->paymentRefund('uuid', new PaymentRefundDto(
        reason: 'Customer requested refund',
        totalAmount: new PaymentTotalAmountDto(amount: 0.9, currency: 'PHP')
    ));

    assertInstanceOf(RefundPayment200Response::class, $dto);

    assertSame($data, json_decode(json_encode($dto), true));
});

it('return status 202', function () {

    $data = [
        'message' => 'Transaction had been received and is still ongoing',
        'status' => 'ONGOING',
    ];
    MockClient::global([
        PaymentRefundRequest::class => new MockResponse(
            body: $data,
            status: 202,
        ),

    ]);

    $dto = paymaya()->paymentRefund('uuid', new PaymentRefundDto(
        reason: 'Customer requested refund',
        totalAmount: new PaymentTotalAmountDto(amount: 0.9, currency: 'PHP')
    ));

    assertInstanceOf(RefundPayment202Response::class, $dto);

    expect($dto)
        ->status->toBe($data['status'])
        ->message->toBe($data['message']);
});
