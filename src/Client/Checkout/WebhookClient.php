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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(WebhookRequest $webhookRequest, int $uriVersion = 1): void
    {
        $this->secretPost(['json' => $webhookRequest], $uriVersion);
    }

    /**
     * @param  int  $uriVersion
     *
     * @return \Lloricode\Paymaya\Response\Checkout\WebhookResponse[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int $uriVersion = 1): array
    {
        try {
            $content = $this->secretGet([], $uriVersion)
                ->getBody()
                ->getContents();
        } catch (GuzzleException $e) {
            if ($e->getCode()) {
                return [];
            }

            throw $e;
        }

        $array = [];
        foreach (json_decode($content, true) as $value) {
            $array[$value['name']] = WebhookResponse::new()
                ->setId($value['id'])
                ->setName($value['name'])
                ->setCallbackUrl($value['callbackUrl']);
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
        $this->secretPut($webhookRequest->getId(), ['json' => $webhookRequest]);
    }

    /**
     * @param  string  $id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(string $id): void
    {
        $this->secretDelete($id);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteAll(): void
    {
        foreach ($this->get() as $webhookResponse) {
            $this->delete($webhookResponse->getId());
        }
    }

    protected function uri(int $uriVersion): string
    {
        return "/checkout/v$uriVersion/webhooks";
    }
}
