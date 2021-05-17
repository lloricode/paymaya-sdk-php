<?php

namespace Lloricode\Paymaya\Client;

use GuzzleHttp\Exception\GuzzleException;
use Lloricode\Paymaya\Request\Webhook\Webhook;

class WebhookClient extends BaseClient
{
    /**
     * @param  \Lloricode\Paymaya\Request\Webhook\Webhook  $webhookRequest
     *
     * @return \Lloricode\Paymaya\Request\Webhook\Webhook
     * @throws \GuzzleHttp\Exception\GuzzleException|\Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function register(Webhook $webhookRequest): Webhook
    {
        $bodyContent = $this->secretPost(['json' => $webhookRequest])
            ->getBody()
            ->getContents();

        return new Webhook((array)json_decode($bodyContent));
    }

    /**
     * @return \Lloricode\Paymaya\Request\Webhook\Webhook[]
     * @throws \GuzzleHttp\Exception\GuzzleException|\Spatie\DataTransferObject\Exceptions\UnknownProperties
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
            $array[$value['name']] = new Webhook($value);
        }

        return $array;
//        return Webhook::arrayOf(json_decode($content, true));
    }

    /**
     * @param  \Lloricode\Paymaya\Request\Webhook\Webhook  $webhookRequest
     *
     * @return \Lloricode\Paymaya\Request\Webhook\Webhook
     * @throws \GuzzleHttp\Exception\GuzzleException|\Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function update(Webhook $webhookRequest): Webhook
    {
        $bodyContent = $this->secretPut($webhookRequest->id ?: '', ['json' => $webhookRequest])->getBody()
            ->getContents();

        return new Webhook((array)json_decode($bodyContent));
    }

    /**
     * @param  \Lloricode\Paymaya\Request\Webhook\Webhook  $webhookRequest
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(Webhook $webhookRequest): void
    {
        $this->secretDelete($webhookRequest->id ?: '');
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException|\Spatie\DataTransferObject\Exceptions\UnknownProperties
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
