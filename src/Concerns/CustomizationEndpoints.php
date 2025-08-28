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
    public function customizations(): CustomizationDto
    {
        return $this->send(new RetrieveCustomizationRequest)->dtoOrFail();
    }

    public function createCustomization(CustomizationDto $customizationDto): CustomizationDto
    {
        return $this->send(new SetCustomizationRequest($customizationDto))->dtoOrFail();
    }

    public function deleteCustomization(): self
    {
        $this->send(new RemoveCustomizationRequest);

        return $this;
    }
}
