<?php

namespace Lloricode\Paymaya\Tests;

use ErrorException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Lloricode\Paymaya\Client\Checkout\CustomizationClient;
use Lloricode\Paymaya\Request\Checkout\Customization\Customization;

class CustomizationTest extends TestCase
{
    /**
     * @test
     */
    public function register()
    {
        $data = '{
    "logoUrl": "https://image-logo.png",
    "iconUrl": "https://image-icon.png",
    "appleTouchIconUrl": "https://image-apple.png",
    "customTitle": "Test Title Mock",
    "colorScheme": "#e01c44",
    "redirectTimer": 3,
    "hideReceiptInput": true,
    "skipResultPage": false,
    "showMerchantName": true
}';
        $mock = new MockHandler(
            [
                new Response(
                    200,
                    [],
                    $data,
                ),
            ]
        );

        try {
            $response = (new CustomizationClient(self::generatePaymayaClient($mock)))
                ->register(
                    (new Customization())
                        ->setLogoUrl('https://image-logo.png')
                        ->setIconUrl('https://image-icon.png')
                        ->setAppleTouchIconUrl('https://image-apple.png')
                        ->setCustomTitle('Test Title Mock')
                        ->setColorScheme('#e01c44')
                );
        } catch (ErrorException $e) {
            $this->fail('ErrorException');
        } catch (ClientException $e) {
            $this->fail('ClientException: '.$e->getMessage().$e->getResponse()->getBody());
        } catch (GuzzleException $e) {
            $this->fail('GuzzleException');
        }

        $this->assertSame(
            json_encode(json_decode($data), JSON_PRETTY_PRINT),
            json_encode($response->toArray(), JSON_PRETTY_PRINT)
        );
    }

    /**
     * @test
     */
    public function retrieve()
    {
        $data = '{
    "logoUrl": "https://image-logo.png",
    "iconUrl": "https://image-icon.png",
    "appleTouchIconUrl": "https://image-apple.png",
    "customTitle": "Test Title Mock",
    "colorScheme": "#e01c44",
    "redirectTimer": 3,
    "hideReceiptInput": true,
    "skipResultPage": false,
    "showMerchantName": true
}';
        $mock = new MockHandler(
            [
                new Response(
                    200,
                    [],
                    $data,
                ),
            ]
        );

        $response = (new CustomizationClient(self::generatePaymayaClient($mock)))
            ->retrieve();


        $this->assertSame(
            json_encode(json_decode($data), JSON_PRETTY_PRINT),
            json_encode($response->toArray(), JSON_PRETTY_PRINT)
        );
    }

    /**
     * @test
     */
    public function retrieve_no_data()
    {
        $mock = new MockHandler(
            [
                new Response(
                    404,
                ),
            ]
        );

        $response = (new CustomizationClient(self::generatePaymayaClient($mock)))
            ->retrieve();


        $this->assertSame(
            json_encode(json_decode(json_encode(new Customization())), JSON_PRETTY_PRINT),
            json_encode($response->toArray(), JSON_PRETTY_PRINT)
        );
    }

    /**
     * @test
     */
    public function delete_data()
    {
        $mock = new MockHandler(
            [
                new Response(
                    204,
                ),
            ]
        );

        $history = [];

        (new CustomizationClient(self::generatePaymayaClient($mock, $history)))
            ->delete();

        /** @var \GuzzleHttp\Psr7\Response $response */
        $response = $history[0]['response'];

        $this->assertCount(1, $history);
        $this->assertEquals(204, $response->getStatusCode());
    }
}
