<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Concerns;

use Lloricode\Paymaya\DataTransferObjects\Checkout\Customization\CustomizationDto;
use Lloricode\Paymaya\Requests\Customization\RemoveCustomizationRequest;
use Lloricode\Paymaya\Requests\Customization\RetrieveCustomizationRequest;
use Lloricode\Paymaya\Requests\Customization\SetCustomizationRequest;

/** @mixin \Lloricode\Paymaya\Paymaya */
trait CustomizationEndpoints
{
    /**
     * @throws \Saloon\Exceptions\Request\FatalRequestException
     * @throws \Saloon\Exceptions\Request\RequestException
     * @throws \Saloon\Exceptions\Request\ClientException
     */
    public function customizations(): CustomizationDto
    {
        return $this->send(new RetrieveCustomizationRequest)->dto();
    }

    /**
     * @throws \Saloon\Exceptions\Request\FatalRequestException
     * @throws \Saloon\Exceptions\Request\RequestException
     * @throws \Saloon\Exceptions\Request\ClientException
     */
    public function createCustomization(CustomizationDto $customizationDto): CustomizationDto
    {
        return $this->send(new SetCustomizationRequest($customizationDto))->dto();
    }

    /**
     * @throws \Saloon\Exceptions\Request\FatalRequestException
     * @throws \Saloon\Exceptions\Request\RequestException
     * @throws \Saloon\Exceptions\Request\ClientException
     */
    public function deleteCustomization(): self
    {
        $this->send(new RemoveCustomizationRequest);

        return $this;
    }
}
