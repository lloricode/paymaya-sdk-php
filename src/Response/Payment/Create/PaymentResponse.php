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
        public string $requestReferenceNumber,
        public ?string $description = null,
        public ?string $paymentTokenId = null,
        public ?FundSource $fundSource = null,
        public ?Receipt $receipt = null,
        public ?string $approvalCode = null,
        public ?string $receiptNumber = null,
    ) {}

    public static function fromArray(array $array): self
    {
        $array['amount'] = (float) $array['amount'];

        if (isset($array['fundSource'])) {
            $array['fundSource'] = new FundSource(
                $array['fundSource']['type'],
                $array['fundSource']['id'],
                $array['fundSource']['description'],
                new Detail(
                    ...$array['fundSource']['details']
                )
            );
        }

        if (isset($array['receipt'])) {
            $array['receipt'] = new Receipt(
                ...$array['receipt']
            );
        }

        return new self(...$array);
    }
}
