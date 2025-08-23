<?php

declare(strict_types=1);

use Lloricode\Paymaya\Test\TestHelper;

use function PHPUnit\Framework\assertJsonStringEqualsJsonString;

test('json check exact from docs', function () {
    assertJsonStringEqualsJsonString(
        TestHelper::jsonCheckoutDataFromDocs(),
        json_encode(TestHelper::buildCheckout())
    );
});
