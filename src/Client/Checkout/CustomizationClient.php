<?php

namespace Lloricode\Paymaya\Client\Checkout;

use Lloricode\Paymaya\Client\BaseClient;
use Lloricode\Paymaya\Request\Checkout\Customization\Customization;

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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function register(Customization $customization): Customization
    {
        $bodyContent = $this->secretPost(['json' => $customization])
            ->getBody()
            ->getContents();

        return new Customization((array)json_decode($bodyContent));
    }

    /**
     * @return \Lloricode\Paymaya\Request\Checkout\Customization\Customization
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function retrieve(): Customization
    {
        $content = $this->secretGet()
            ->getBody()
            ->getContents();


        return new Customization((array)json_decode($content, true));
    }
}
