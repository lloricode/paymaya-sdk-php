<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Concerns;

use Lloricode\Paymaya\DataTransferObjects\Webhook\WebhookDto;
use Lloricode\Paymaya\Requests\Webhook\CreateWebhookRequest;
use Lloricode\Paymaya\Requests\Webhook\DeleteWebhookRequest;
use Lloricode\Paymaya\Requests\Webhook\GetAllWebhookRequest;
use Lloricode\Paymaya\Requests\Webhook\UpdateWebhookRequest;

/** @mixin \Lloricode\Paymaya\Paymaya */
trait WebhookEndpoints
{
    /**
     * @return array<string, WebhookDto>
     */
    public function webhooks(): array
    {
        return $this->send(new GetAllWebhookRequest)->dtoOrFail();
    }

    public function createWebhook(WebhookDto $webhookDto): WebhookDto
    {
        return $this->send(new CreateWebhookRequest($webhookDto))->dtoOrFail();
    }

    public function updateWebhooks(WebhookDto $webhookDto): WebhookDto
    {
        return $this->send(new UpdateWebhookRequest($webhookDto))->dtoOrFail();
    }

    public function deleteWebhook(string $webhookId): self
    {
        $this->send(new DeleteWebhookRequest($webhookId));

        return $this;
    }
}
