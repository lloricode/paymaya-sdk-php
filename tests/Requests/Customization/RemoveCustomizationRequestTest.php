<?php

declare(strict_types=1);

use Lloricode\Paymaya\Requests\Customization\RemoveCustomizationRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertEquals;

it('delete data', function () {
    $mockClient = MockClient::global([
        RemoveCustomizationRequest::class => MockResponse::make(
            status: 204,
        ),
    ]);

    $response = paymayaConnectorSend(new RemoveCustomizationRequest);

    $mockClient->assertSentCount(1);
    assertEquals(204, $response->status());
});
