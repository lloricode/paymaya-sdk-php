<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Payment\Refund;

use Lloricode\Paymaya\Response\BaseResponse;

readonly class RefundPayment202Response extends BaseResponse
{
    public function __construct(
        public string $message,
        public string $status,
    ) {}

    public static function fromArray(array $array): self
    {
        return new self(...$array);
    }
}
