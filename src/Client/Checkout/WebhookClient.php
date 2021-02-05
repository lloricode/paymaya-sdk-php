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
     * @param  int  $uriVersion
     *
     * @return \Lloricode\Paymaya\Response\Checkout\WebhookResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function register(WebhookRequest $webhookRequest, int $uriVersion = 1): WebhookResponse
    {
        $bodyContent = $this->secretPost(['json' => $webhookRequest], $uriVersion)
            ->getBody()
            ->getContents();

        return WebhookResponse::new()->fromArray((array)json_decode($bodyContent));
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
