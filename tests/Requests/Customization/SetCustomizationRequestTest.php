<?php

declare(strict_types=1);

use Lloricode\Paymaya\DataTransferObjects\Checkout\Customization\CustomizationDto;
use Lloricode\Paymaya\Requests\Customization\SetCustomizationRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertSame;

it('register', function () {
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
        SetCustomizationRequest::class => new MockResponse(
            body: $data,
        ),
    ]);

    $response = paymaya()->createCustomization(
        new CustomizationDto(
            logoUrl: 'https://image-logo.png',
            iconUrl: 'https://image-icon.png',
            appleTouchIconUrl: 'https://image-apple.png',
            customTitle: 'Test Title Mock',
            colorScheme: '#e01c44',
        )
    );

    assertSame(
        json_encode(json_decode($data), JSON_PRETTY_PRINT),
        json_encode((array) $response, JSON_PRETTY_PRINT)
    );
});
