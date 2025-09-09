<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Requests\Checkout;

use Lloricode\Paymaya\DataTransferObjects\Checkout\CheckoutDto;
use Lloricode\Paymaya\Response\Checkout\CheckoutResponse;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * https://developers.maya.ph/reference/createv1checkout
 */
class CreateCheckoutRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly CheckoutDto $checkoutDto) {}

    public function resolveEndpoint(): string
    {
        return 'checkout/v1/checkouts';
    }

    protected function defaultBody(): array
    {
        return (array) $this->checkoutDto;
    }

    public function createDtoFromResponse(Response $response): CheckoutResponse
    {
        /** @var array{checkoutId:string, redirectUrl:string} $array */
        $array = $response->array();

        return new CheckoutResponse(...$array);
    }
}
