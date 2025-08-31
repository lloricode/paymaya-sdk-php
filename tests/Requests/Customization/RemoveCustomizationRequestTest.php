<?php

declare(strict_types=1);

use Lloricode\Paymaya\Requests\Customization\RemoveCustomizationRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

it('delete data', function () {
    $mockClient = MockClient::global([
        RemoveCustomizationRequest::class => new MockResponse(
            status: 204,
        ),
    ]);

    paymaya()->deleteCustomization();

    $mockClient->assertSentCount(1);

});
