<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Client;

use GuzzleHttp\Exception\GuzzleException;
use Lloricode\Paymaya\Request\Webhook\Webhook;

class WebhookClient extends BaseClient
{
    /** @throws \GuzzleHttp\Exception\GuzzleException*/
    public function register(Webhook $webhookRequest): Webhook
    {
        $bodyContent = $this->secretPost(['json' => $webhookRequest])
            ->getBody()
            ->getContents();

        return new Webhook(...((array) json_decode($bodyContent)));
    }

    /**
     * @return \Lloricode\Paymaya\Request\Webhook\Webhook[]
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function retrieve(): array
    {
        try {
            $content = $this->secretGet()
                ->getBody()
                ->getContents();
        } catch (GuzzleException $e) {
            if ($e->getCode() === 404) {
                return [];
            }

            throw $e;
        }

        $array = [];
        foreach (json_decode($content, true) as $value) {
            $array[$value['name']] = new Webhook(...$value);
        }

        return $array;
        //        return Webhook::arrayOf(json_decode($content, true));
    }

    /** @throws \GuzzleHttp\Exception\GuzzleException*/
    public function update(Webhook $webhookRequest): Webhook
    {
        $bodyContent = $this->secretPut($webhookRequest->id ?: '', ['json' => $webhookRequest])->getBody()
            ->getContents();

        return new Webhook(...((array) json_decode($bodyContent)));
    }

    /** @throws \GuzzleHttp\Exception\GuzzleException */
    public function delete(Webhook $webhookRequest): void
    {
        $this->secretDelete($webhookRequest->id ?: '');
    }

    /** @throws \GuzzleHttp\Exception\GuzzleException*/
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
