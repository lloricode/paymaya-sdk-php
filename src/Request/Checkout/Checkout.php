<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Carbon\Carbon;
use ErrorException;
use Lloricode\Paymaya\Casters\CarbonCaster;
use Lloricode\Paymaya\Request\Base;
use Lloricode\Paymaya\Request\Checkout\Buyer\Buyer;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetail;
use Spatie\DataTransferObject\Attributes\CastWith;

/**
 * https://hackmd.io/@paymaya-pg/Checkout#Body
 * https://developers.paymaya.com/blog/entry/paymaya-checkout-api-overview
 *
 * @method Checkout setId(string $id)
 * @method Checkout setTotalAmount(TotalAmount $totalAmount)
 * @method Checkout setBuyer(Buyer $buyer)
 * @method Checkout setRedirectUrl(RedirectUrl $redirectUrl)
 * @method Checkout setStatus(string $status)
 * @method Checkout setPaymentStatus(string $paymentStatus)
 * @method Checkout setRequestReferenceNumber(string $requestReferenceNumber)
 * @method Checkout setMetadata(MetaData $metadata)
 * @method Checkout setReceiptNumber(string $receiptNumber)
 * @method Checkout setCreatedAt(Carbon $createdAt)
 * @method Checkout setUpdatedAt(Carbon $updatedAt)
 * @method Checkout setExpiredAt(Carbon $expiredAt)
 * @method Checkout setExpressCheckout(bool $expressCheckout)
 * @method Checkout setRefundedAmount(float $refundedAmount)
 * @method Checkout setCanPayPal(bool $canPayPal)
 * @method Checkout setPaymentScheme(string $paymentScheme)
 * @method Checkout setMerchant(Merchant $merchant)
 * @method Checkout setPaymentDetails($paymentDetails)
 * @method Checkout setTransactionReferenceNumber(string $transactionReferenceNumber)
 */
class Checkout extends Base
{
    public ?string $id = null;
    public TotalAmount $totalAmount;
    public ?Buyer $buyer = null;

    /**
     * @var \Lloricode\Paymaya\Request\Checkout\Item[]
     */
    public array $items = [];
    public ?RedirectUrl $redirectUrl = null;
    public ?string $status = null;
    public ?string $paymentStatus = null;
    public ?string $requestReferenceNumber = null;
    public ?MetaData $metadata = null;

    // responses
    // https://hackmd.io/@paymaya-pg/Checkout#Get-Checkout---GET-httpspg-sandboxpaymayacomcheckoutv1checkoutscheckoutId
    public ?string $receiptNumber = null;
    #[CastWith(CarbonCaster::class)]
    public ?Carbon $createdAt = null;
    #[CastWith(CarbonCaster::class)]
    public ?Carbon $updatedAt = null;
    #[CastWith(CarbonCaster::class)]
    public ?Carbon $expiredAt = null;
    public ?bool $expressCheckout = null;
    public float $refundedAmount = 0;
    public ?bool $canPayPal = null;
    public ?string $paymentScheme = null;
    public ?Merchant $merchant = null;

    public ?PaymentDetail $paymentDetails = null;
    public ?string $transactionReferenceNumber;

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __construct(...$args)
    {
        self::setClassIfKeyNotExist($args, 'totalAmount', TotalAmount::class);

        parent::__construct(...$args);
    }

    public function __call($name, $arguments): self
    {
        if ('setItems' == $name) {
            throw new ErrorException(sprintf('%s::%s() not found.', static::class, $name));
        }

        return parent::__call($name, $arguments);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
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

    public function addItem(Item $itemRequest): self
    {
        $this->items[] = $itemRequest;

        return $this;
    }
}
