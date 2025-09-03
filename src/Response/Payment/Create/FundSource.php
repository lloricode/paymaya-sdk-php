<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Response\Payment\Create;

use Lloricode\Paymaya\Response\BaseResponse;

readonly class FundSource extends BaseResponse
{
    public function __construct(
        public string $type,
        public string $id,
        public string $description,
        public Detail $details,
    ) {}
}
