<?php

namespace Lloricode\Paymaya\Client\Checkout;

use GuzzleHttp\Exception\GuzzleException;
use Lloricode\Paymaya\Client\BaseClient;
use Lloricode\Paymaya\Request\Checkout\Webhook;

class WebhookClient extends BaseClient
{
    /**
     * @param  \Lloricode\Paymaya\Request\Checkout\Webhook  $webhookRequest
     *
     * @return \Lloricode\Paymaya\Request\Checkout\Webhook
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function register(Webhook $webhookRequest): Webhook
    {
        $bodyContent = $this->secretPost(['json' => $webhookRequest])
            ->getBody()
            ->getContents();

        return (new Webhook())->fromArray((array)json_decode($bodyContent));
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
            $array[$value['name']] = (new Webhook())
                ->fromArray($value);
        }

        return $array;
    }

    /**
     * @param  \Lloricode\Paymaya\Request\Checkout\Webhook  $webhookRequest
     *
     * @return \Lloricode\Paymaya\Request\Checkout\Webhook
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(Webhook $webhookRequest): Webhook
    {
        $bodyContent = $this->secretPut($webhookRequest->getId() ?: '', ['json' => $webhookRequest])->getBody()
            ->getContents();

        return (new Webhook())->fromArray((array)json_decode($bodyContent));
    }

    /**
     * @param  \Lloricode\Paymaya\Request\Checkout\Webhook  $webhookRequest
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(Webhook $webhookRequest): void
    {
        $this->secretDelete($webhookRequest->getId() ?: '');
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteAll(): void
    {
        foreach ($this->retrieve() as $webhookResponse) {
            $this->delete($webhookResponse);
        }
    }

    public static function uri(int $uriVersion = 1): string
    {
        return "/checkout/v$uriVersion/webhooks";
    }
}
