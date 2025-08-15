<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Webhook;

use Lloricode\Paymaya\DataTransferObjects\BaseDto;

/**
 * https://developers.paymaya.com/blog/entry/paymaya-checkout-api-overview#webhooks
 *
 * @method self setId(string $id)
 * @method self setName(string $name)
 * @method self setCallbackUrl(string $callbackUrl)
 * @method self setCreatedAt(string $createdAt)
 * @method self setUpdatedAt(string $updatedAt)
 */
class WebhookDto extends BaseDto
{
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $callbackUrl = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {}
}
