<?php

declare(strict_types=1);

use Lloricode\Paymaya\DataTransferObjects\Checkout\Customization\CustomizationDto;
use Lloricode\Paymaya\Requests\Customization\RetrieveCustomizationRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertSame;

it('retrieve', function () {
    $data = '{
    "logoUrl": "https://image-logo.png",
    "iconUrl": "https://image-icon.png",
    "appleTouchIconUrl": "https://image-apple.png",
    "customTitle": "Test Title Mock",
    "colorScheme": "#e01c44",
    "hideReceiptInput": true,
    "skipResultPage": false,
    "showMerchantName": true,
    "redirectTimer": 3
}';

    MockClient::global([
        RetrieveCustomizationRequest::class => new MockResponse(
            body: $data,
        ),
    ]);

    $response = paymaya()->customizations();

    assertSame(
        json_encode(json_decode($data), JSON_PRETTY_PRINT),
        json_encode((array) $response, JSON_PRETTY_PRINT)
    );
});

it('retrieve no data', function () {
    MockClient::global([
        RetrieveCustomizationRequest::class => new MockResponse(
            status: 404,
        ),
    ]);

    $response = paymaya()->customizations();

    assertSame(
        json_encode(json_decode(json_encode(new CustomizationDto)), JSON_PRETTY_PRINT),
        json_encode((array) $response, JSON_PRETTY_PRINT)
    );
})
    ->todo('handle 404');
