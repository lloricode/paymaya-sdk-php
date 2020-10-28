<?php

namespace Lloricode\Paymaya\Client\Checkout;

use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Lloricode\Paymaya\Client\BaseClient;
use Lloricode\Paymaya\Request\Checkout\WebhookRequest;
use Lloricode\Paymaya\Response\Checkout\WebhookResponse;

class WebhookClient extends BaseClient
{
    /**
     * @param  \Lloricode\Paymaya\Request\Checkout\WebhookRequest  $webhookRequest
     * @param  int  $uriVersion
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function register(WebhookRequest $webhookRequest, int $uriVersion = 1): void
    {
        $this->secretPost(['json' => $webhookRequest], $uriVersion);
    }

    /**
     * @param  int  $uriVersion
     *
     * @return \Lloricode\Paymaya\Response\Checkout\WebhookResponse[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function retrieve(int $uriVersion = 1): array
    {
        try {
            $content = $this->secretGet([], $uriVersion)
                ->getBody()
                ->getContents();
        } catch (GuzzleException $e) {
            if ($e->getCode() == '404') {
                return [];
            }

            throw $e;
        }

        $array = [];
        foreach (json_decode($content, true) as $value) {
            $array[$value['name']] = WebhookResponse::new()
                ->setId($value['id'])
                ->setName($value['name'])
                ->setCallbackUrl($value['callbackUrl'])
                ->setCreatedAt(Carbon::parse($value['createdAt']))
                ->setUpdatedAt(Carbon::parse($value['updatedAt']));
        }

        return $array;
    }

    /**
     * @param  \Lloricode\Paymaya\Request\Checkout\WebhookRequest  $webhookRequest
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(WebhookRequest $webhookRequest): void
    {
        $this->secretPut($webhookRequest->getId() ?: '', ['json' => $webhookRequest]);
    }

    /**
     * @param  \Lloricode\Paymaya\Request\Checkout\WebhookRequest  $webhookRequest
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(WebhookRequest $webhookRequest): void
    {
        $this->secretDelete($webhookRequest->getId() ?: '');
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteAll(): void
    {
        foreach ($this->retrieve() as $webhookResponse) {
            $this->delete(WebhookRequest::new()->setResponse($webhookResponse));
        }
    }

    protected function uri(int $uriVersion): string
    {
        return "/checkout/v$uriVersion/webhooks";
    }
}
