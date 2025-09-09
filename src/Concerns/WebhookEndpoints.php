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
     *
     * @throws \Saloon\Exceptions\Request\FatalRequestException
     * @throws \Saloon\Exceptions\Request\RequestException
     * @throws \Saloon\Exceptions\Request\ClientException
     */
    public function webhooks(): array
    {
        /** @var array<string, WebhookDto> $dto */
        $dto = $this->send(new GetAllWebhookRequest)->dto();

        return $dto;
    }

    /**
     * @throws \Saloon\Exceptions\Request\FatalRequestException
     * @throws \Saloon\Exceptions\Request\RequestException
     * @throws \Saloon\Exceptions\Request\ClientException
     */
    public function createWebhook(WebhookDto $webhookDto): WebhookDto
    {
        /** @var WebhookDto $dto */
        $dto = $this->send(new CreateWebhookRequest($webhookDto))->dto();

        return $dto;
    }

    /**
     * @throws \Saloon\Exceptions\Request\FatalRequestException
     * @throws \Saloon\Exceptions\Request\RequestException
     * @throws \Saloon\Exceptions\Request\ClientException
     */
    public function updateWebhooks(WebhookDto $webhookDto): WebhookDto
    {
        /** @var WebhookDto $dto */
        $dto = $this->send(new UpdateWebhookRequest($webhookDto))->dto();

        return $dto;
    }

    /**
     * @throws \Saloon\Exceptions\Request\FatalRequestException
     * @throws \Saloon\Exceptions\Request\RequestException
     * @throws \Saloon\Exceptions\Request\ClientException
     */
    public function deleteWebhook(string $webhookId): self
    {
        $this->send(new DeleteWebhookRequest($webhookId));

        return $this;
    }
}
