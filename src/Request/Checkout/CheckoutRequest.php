<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Carbon\Carbon;
use Lloricode\Paymaya\Request\BaseRequest;
use Lloricode\Paymaya\Request\Checkout\Buyer\BuyerRequest;

/**
 * https://hackmd.io/@paymaya-pg/Checkout
 * https://developers.paymaya.com/blog/entry/paymaya-checkout-api-overview
 */
class CheckoutRequest extends BaseRequest
{
    public ?string $id = null;
    public TotalAmountRequest $totalAmount;
    public ?BuyerRequest $buyer = null;

    /**
     * @var \Lloricode\Paymaya\Request\Checkout\ItemRequest[]
     */
    public array $items = [];
    public ?RedirectUrlRequest $redirectUrl = null;
    public ?string $status = null;
    public ?string $paymentStatus = null;
    public ?string $requestReferenceNumber = null;
    public ?MetaDataRequest $metadata = null;

    // responses
    // https://hackmd.io/@paymaya-pg/Checkout#Get-Checkout---GET-httpspg-sandboxpaymayacomcheckoutv1checkoutscheckoutId
    public ?string $receiptNumber = null;
    public ?Carbon $createdAt = null;
    public ?Carbon $updatedAt = null;
    public ?Carbon $expiredAt = null;
    public ?bool $expressCheckout = null;
    public float $refundedAmount = 0;
    public ?bool $canPayPal = null;
    public ?string $paymentScheme = null;
    public ?Merchant $merchant = null;
    /**
     * @todo add typehint
     * @var null
     */
    public $paymentDetails = null;
    public ?string $transactionReferenceNumber;

    public function __construct(array $parameters = [])
    {
        self::setClassIfKeyNotExist($parameters, 'totalAmount', TotalAmountRequest::class);
        self::setCarbon($parameters, 'createdAt');
        self::setCarbon($parameters, 'updatedAt');
        self::setCarbon($parameters, 'expiredAt');
        self::toFloat($parameters, 'refundedAmount');

        parent::__construct($parameters);
    }

    public function setTotalAmount(TotalAmountRequest $totalAmountRequest): self
    {
        $this->totalAmount = $totalAmountRequest;

        return $this;
    }

    public function setBuyer(?BuyerRequest $buyerRequest): self
    {
        $this->buyer = $buyerRequest;

        return $this;
    }

    public function addItemRequest(ItemRequest $itemRequest): self
    {
        $this->items[] = $itemRequest;

        return $this;
    }

    public function setRedirectUrl(?RedirectUrlRequest $redirectUrlRequest): self
    {
        $this->redirectUrl = $redirectUrlRequest;

        return $this;
    }

    public function setRequestReferenceNumber(string $requestReferenceNumber): self
    {
        $this->requestReferenceNumber = $requestReferenceNumber;

        return $this;
    }

    public function setMetadata(?MetaDataRequest $metaDataRequest): self
    {
        $this->metadata = $metaDataRequest;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'totalAmount' => $this->totalAmount,
            'buyer' => $this->buyer,
            'items' => $this->items,
            'redirectUrl' => $this->redirectUrl,
            'requestReferenceNumber' => $this->requestReferenceNumber,
            'metadata' => $this->metadata,
            'status' => $this->status,
            'paymentStatus' => $this->paymentStatus,
        ];
    }

    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setReceiptNumber(?string $receiptNumber): self
    {
        $this->receiptNumber = $receiptNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getReceiptNumber(): ?string
    {
        return $this->receiptNumber;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?Carbon $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?Carbon $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getExpressCheckout(): ?bool
    {
        return $this->expressCheckout;
    }

    public function setExpressCheckout(?bool $expressCheckout): self
    {
        $this->expressCheckout = $expressCheckout;

        return $this;
    }

    public function getRefundedAmount()
    {
        return $this->refundedAmount;
    }

    public function setRefundedAmount($refundedAmount): self
    {
        $this->refundedAmount = $refundedAmount;

        return $this;
    }

    public function getCanPayPal(): ?bool
    {
        return $this->canPayPal;
    }

    public function setCanPayPal(?bool $canPayPal): self
    {
        $this->canPayPal = $canPayPal;

        return $this;
    }

    public function getExpiredAt(): ?Carbon
    {
        return $this->expiredAt;
    }

    public function setExpiredAt(?Carbon $expiredAt): self
    {
        $this->expiredAt = $expiredAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPaymentStatus(): ?string
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus(?string $paymentStatus): self
    {
        $this->paymentStatus = $paymentStatus;

        return $this;
    }
}
