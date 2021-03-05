<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Carbon\Carbon;
use ErrorException;
use Lloricode\Paymaya\Request\Base;
use Lloricode\Paymaya\Request\Checkout\Buyer\Buyer;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetail;

/**
 * https://hackmd.io/@paymaya-pg/Checkout#Body
 * https://developers.paymaya.com/blog/entry/paymaya-checkout-api-overview
 *
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setId(string $id)
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setTotalAmount(TotalAmount $totalAmount)
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setBuyer(Buyer $buyer)
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setRedirectUrl(RedirectUrl $redirectUrl)
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setStatus(string $status)
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setPaymentStatus(string $paymentStatus)
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setRequestReferenceNumber(string $requestReferenceNumber)
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setMetadata(MetaData $metadata)
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setReceiptNumber(string $receiptNumber)
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setCreatedAt(Carbon $createdAt)
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setUpdatedAt(Carbon $updatedAt)
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setExpiredAt(Carbon $expiredAt)
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setExpressCheckout(bool $expressCheckout)
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setRefundedAmount(float $refundedAmount)
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setCanPayPal(bool $canPayPal)
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setPaymentScheme(string $paymentScheme)
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setMerchant(Merchant $merchant)
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setPaymentDetails($paymentDetails)
 * @method \Lloricode\Paymaya\Request\Checkout\Checkout setTransactionReferenceNumber(string $transactionReferenceNumber)
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
    public ?Carbon $createdAt = null;
    public ?Carbon $updatedAt = null;
    public ?Carbon $expiredAt = null;
    public ?bool $expressCheckout = null;
    public float $refundedAmount = 0;
    public ?bool $canPayPal = null;
    public ?string $paymentScheme = null;
    public ?Merchant $merchant = null;

    public ?PaymentDetail $paymentDetails = null;
    public ?string $transactionReferenceNumber;

    public function __construct(array $parameters = [])
    {
        self::setClassIfKeyNotExist($parameters, 'totalAmount', TotalAmount::class);
        self::setCarbon($parameters, 'createdAt');
        self::setCarbon($parameters, 'updatedAt');
        self::setCarbon($parameters, 'expiredAt');
        self::toFloat($parameters, 'refundedAmount');

        parent::__construct($parameters);
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

    public function addItem(Item $itemRequest): self
    {
        $this->items[] = $itemRequest;

        return $this;
    }
}
