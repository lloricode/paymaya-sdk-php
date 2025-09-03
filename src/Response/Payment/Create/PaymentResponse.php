<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Payment\Create;

use Lloricode\Paymaya\Response\BaseResponse;

readonly class PaymentResponse extends BaseResponse
{
    public function __construct(
        public string $id,
        public bool $isPaid,
        public string $status,
        public float $amount,
        public string $currency,
        public bool $canVoid,
        public bool $canRefund,
        public bool $canCapture,
        public string $createdAt,
        public string $updatedAt,
        public string $description,
        public string $paymentTokenId,
        public FundSource $fundSource,
        public Receipt $receipt,
        public string $approvalCode,
        public string $receiptNumber,
        public string $requestReferenceNumber,
    ) {}

    public static function fromArray(array $array): self
    {
        $array['amount'] = (float) $array['amount'];

        $array['fundSource'] = new FundSource(
            $array['fundSource']['type'],
            $array['fundSource']['id'],
            $array['fundSource']['description'],
            new Detail(
                ...$array['fundSource']['details']
            )
        );

        $array['receipt'] = new Receipt(
            ...$array['receipt']
        );

        return new self(...$array);
    }
}
