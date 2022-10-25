<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Client\Checkout;

use GuzzleHttp\Exception\GuzzleException;
use Lloricode\Paymaya\Client\BaseClient;
use Lloricode\Paymaya\Request\Checkout\Customization\Customization;

/**
 * https://hackmd.io/@paymaya-pg/Checkout#Customization-API
 *
 */
class CustomizationClient extends BaseClient
{
    public static function uri(int $uriVersion = 1): string
    {
        return "checkout/v$uriVersion/customizations";
    }

    /**
     * @param  \Lloricode\Paymaya\Request\Checkout\Customization\Customization  $customization
     *
     * @return \Lloricode\Paymaya\Request\Checkout\Customization\Customization
     * @throws \GuzzleHttp\Exception\GuzzleException|\Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function register(Customization $customization): Customization
    {
        $bodyContent = $this->secretPost(['json' => $customization])
            ->getBody()
            ->getContents();

        return new Customization((array) json_decode($bodyContent));
    }

    /**
     * @return \Lloricode\Paymaya\Request\Checkout\Customization\Customization
     * @throws \GuzzleHttp\Exception\GuzzleException|\Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function retrieve(): Customization
    {
        try {
            $content = $this->secretGet()
                ->getBody()
                ->getContents();
        } catch (GuzzleException $e) {
            if ($e->getCode() == '404') {
                return new Customization();
            }

            throw $e;
        }

        return new Customization((array) json_decode($content, true));
    }

    /** @throws \GuzzleHttp\Exception\GuzzleException */
    public function delete(): void
    {
        $this->secretDelete();
    }
}
