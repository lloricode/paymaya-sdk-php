<?php

namespace Lloricode\Paymaya\Client\Checkout;

use GuzzleHttp\Exception\GuzzleException;
use Lloricode\Paymaya\Client\BaseClient;
use Lloricode\Paymaya\Request\Checkout\WebhookRequest;
use Lloricode\Paymaya\Response\Checkout\WebhookResponse;

class WebhookClient extends BaseClient
{
    /**
     * @param  \Lloricode\Paymaya\Request\Checkout\WebhookRequest  $webhookRequest
     *
     * @return \Lloricode\Paymaya\Response\Checkout\WebhookResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function register(WebhookRequest $webhookRequest): WebhookResponse
    {
        $bodyContent = $this->secretPost(['json' => $webhookRequest])
            ->getBody()
            ->getContents();

        return (new WebhookResponse())->fromArray((array)json_decode($bodyContent));
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function retrieve(): array
    {
        try {
            $content = $this->secretGet()
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
            $array[$value['name']] = (new WebhookResponse())
                ->fromArray($value);
        }

        return $array;
    }

    /**
     * @param  \Lloricode\Paymaya\Request\Checkout\WebhookRequest  $webhookRequest
     *
     * @return \Lloricode\Paymaya\Response\Checkout\WebhookResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(WebhookRequest $webhookRequest): WebhookResponse
    {
        $bodyContent = $this->secretPut($webhookRequest->getId() ?: '', ['json' => $webhookRequest])->getBody()
            ->getContents();

        return WebhookResponse::new()->fromArray((array)json_decode($bodyContent));
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

    public static function uri(int $uriVersion = 1): string
    {
        return "/checkout/v$uriVersion/webhooks";
    }
}
