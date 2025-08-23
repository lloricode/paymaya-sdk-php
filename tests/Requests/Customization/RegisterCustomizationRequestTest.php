<?php

declare(strict_types=1);

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Customization\CustomizationDto;
use Lloricode\Paymaya\Requests\Customization\RegisterCustomizationRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertSame;

beforeEach(function () {
    fakeCredentials();
});

it('register', function () {
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

    MockClient::global([
        RegisterCustomizationRequest::class => MockResponse::make(
            body: $data,
        ),
    ]);

    try {
        $response = (new RegisterCustomizationRequest(
            (new CustomizationDto)
                ->setLogoUrl('https://image-logo.png')
                ->setIconUrl('https://image-icon.png')
                ->setAppleTouchIconUrl('https://image-apple.png')
                ->setCustomTitle('Test Title Mock')
                ->setColorScheme('#e01c44')
        ))
            ->send()
            ->dto();
    } catch (ErrorException) {
        $this->fail('ErrorException');
    } catch (ClientException $e) {
        $this->fail('ClientException: '.$e->getMessage().$e->getResponse()->getBody());
    } catch (GuzzleException) {
        $this->fail('GuzzleException');
    }

    assertSame(
        json_encode(json_decode($data), JSON_PRETTY_PRINT),
        json_encode($response->toArray(), JSON_PRETTY_PRINT)
    );
});
