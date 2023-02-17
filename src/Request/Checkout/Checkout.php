<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Request\Checkout;

use ErrorException;
use Lloricode\Paymaya\Request\Base;
use Lloricode\Paymaya\Request\Checkout\Amount\AmountDetail;
use Lloricode\Paymaya\Request\Checkout\Buyer\BillingAddress;
use Lloricode\Paymaya\Request\Checkout\Buyer\Buyer;
use Lloricode\Paymaya\Request\Checkout\Buyer\Contact;
use Lloricode\Paymaya\Request\Checkout\Buyer\ShippingAddress;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetail;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\Amount\Amount;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\Amount\Total;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\EFS;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\Payer\FundingInstrument\Card;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\Payer\FundingInstrument\FundingInstrument;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\Payer\Payer;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\EFS\Receipt;
use Lloricode\Paymaya\Response\Checkout\PaymentDetail\PaymentDetailResponse\PaymentDetailResponse;

/**
 * https://hackmd.io/@paymaya-pg/Checkout#Body
 * https://developers.paymaya.com/blog/entry/paymaya-checkout-api-overview
 *
 * @method Checkout setId(string|int $id)
 * @method Checkout setTotalAmount(TotalAmount $totalAmount)
 * @method Checkout setBuyer(Buyer $buyer)
 * @method Checkout setRedirectUrl(RedirectUrl $redirectUrl)
 * @method Checkout setStatus(string $status)
 * @method Checkout setPaymentStatus(string $paymentStatus)
 * @method Checkout setRequestReferenceNumber(string $requestReferenceNumber)
 * @method Checkout setMetadata(MetaData $metadata)
 * @method Checkout setReceiptNumber(string $receiptNumber)
 * @method Checkout setCreatedAt(string $createdAt)
 * @method Checkout setUpdatedAt(string $updatedAt)
 * @method Checkout setExpiredAt(string $expiredAt)
 * @method Checkout setExpressCheckout(bool $expressCheckout)
 * @method Checkout setRefundedAmount(float|string|int $refundedAmount)
 * @method Checkout setCanPayPal(bool $canPayPal)
 * @method Checkout setPaymentScheme(string $paymentScheme)
 * @method Checkout setMerchant(Merchant $merchant)
 * @method Checkout setPaymentDetails(PaymentDetail $paymentDetails)
 * @method Checkout setTransactionReferenceNumber(string $transactionReferenceNumber)
 */
class Checkout extends Base
{
    public function __construct(
        public string|int|null $id = null,
        public ?TotalAmount $totalAmount = null,
        public ?Buyer $buyer = null,

    /** @var \Lloricode\Paymaya\Request\Checkout\Item[] */
        public array $items = [],
        public ?RedirectUrl $redirectUrl = null,
        public ?string $status = null,
        public ?string $paymentStatus = null,
        public ?string $requestReferenceNumber = null,
        public ?MetaData $metadata = null,

    // responses
    // https://hackmd.io/@paymaya-pg/Checkout#Get-Checkout---GET-httpspg-sandboxpaymayacomcheckoutv1checkoutscheckoutId
        public ?string $receiptNumber = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?string $expiredAt = null,
        public ?bool $expressCheckout = null,
        public float|string|int $refundedAmount = 0,
        public ?bool $canPayPal = null,
        public ?string $paymentScheme = null,
        public ?Merchant $merchant = null,
        public ?PaymentDetail $paymentDetails = null,
        public ?string $transactionReferenceNumber = null,
    ) {
        $this->totalAmount ??= new TotalAmount();
    }

    public function __call(string $name, mixed $arguments): static
    {
        if ('setItems' == $name) {
            throw new ErrorException(sprintf('%s::%s() not found.', static::class, $name));
        }

        return parent::__call($name, $arguments);
    }

    public function addItem(Item $itemRequest): self
    {
        $this->items[] = $itemRequest;

        return $this;
    }

    public static function fromArray(array $data): static
    {
        $clone = $data;
        unset(
            $data['totalAmount'],
            $data['buyer'],
            $data['redirectUrl'],
            $data['merchant'],
            $data['paymentDetails'],
        );

        /** @phpstan-ignore-next-line  */
        $checkout = new static(...$data);

        unset($data);

        if (isset($clone['totalAmount'])) {
            $tmp = $clone['totalAmount'];

            unset($tmp['details']);
            $totalAmount = new TotalAmount(...$tmp);
            unset($tmp);

            if (isset($clone['totalAmount']['details'])) {
                $totalAmount->setDetails(
                    new AmountDetail(...$clone['totalAmount']['details'])
                );
            }

            $checkout->setTotalAmount($totalAmount);
        }
        if (isset($clone['buyer'])) {
            $tmp = $clone['buyer'];

            unset(
                $tmp['contact'],
                $tmp['shippingAddress'],
                $tmp['billingAddress'],
            );
            $buyer = new Buyer(...$tmp);
            unset($tmp);

            if (isset($clone['buyer']['contact'])) {
                $buyer->setContact(new Contact(...$clone['buyer']['contact']));
            }

            if (isset($clone['buyer']['shippingAddress'])) {
                $buyer->setShippingAddress(new ShippingAddress(...$clone['buyer']['shippingAddress']));
            }

            if (isset($clone['buyer']['billingAddress'])) {
                $buyer->setBillingAddress(new BillingAddress(...$clone['buyer']['billingAddress']));
            }

            $checkout->setBuyer(
                $buyer
            );
        }

        if (isset($clone['redirectUrl'])) {
            $checkout->setRedirectUrl(
                new RedirectUrl(...$clone['redirectUrl'])
            );
        }

        if (isset($clone['merchant'])) {
            $checkout->setMerchant(
                new Merchant(...$clone['merchant'])
            );
        }

        if (isset($clone['paymentDetails'])) {
            $clone['paymentDetails']['is3ds'] = $clone['paymentDetails']['3ds'] ?? false;
            unset($clone['paymentDetails']['3ds']);

            if ($clone['paymentDetails']['responses']) {
                if (isset($clone['paymentDetails']['responses']['efs'])) {
                    if (isset($clone['paymentDetails']['responses']['efs']['receipt'])) {
                        $clone['paymentDetails']['responses']['efs']['receipt'] = new Receipt(...$clone['paymentDetails']['responses']['efs']['receipt']);
                    }
                    if (isset($clone['paymentDetails']['responses']['efs']['payer'])) {
                        if (isset($clone['paymentDetails']['responses']['efs']['payer']['fundingInstrument'])) {
                            if (isset($clone['paymentDetails']['responses']['efs']['payer']['fundingInstrument']['card'])) {
                                $clone['paymentDetails']['responses']['efs']['payer']['fundingInstrument']['card'] = new Card(...$clone['paymentDetails']['responses']['efs']['payer']['fundingInstrument']['card']);
                            }

                            $clone['paymentDetails']['responses']['efs']['payer']['fundingInstrument'] = new FundingInstrument(...$clone['paymentDetails']['responses']['efs']['payer']['fundingInstrument']);
                        }

                        $clone['paymentDetails']['responses']['efs']['payer'] = new Payer(...$clone['paymentDetails']['responses']['efs']['payer']);
                    }
                    if (isset($clone['paymentDetails']['responses']['efs']['amount'])) {
                        if (isset($clone['paymentDetails']['responses']['efs']['amount']['total'])) {
                            $clone['paymentDetails']['responses']['efs']['amount']['total'] = new Total(...$clone['paymentDetails']['responses']['efs']['amount']['total']);
                        }

                        $clone['paymentDetails']['responses']['efs']['amount'] = new Amount(...$clone['paymentDetails']['responses']['efs']['amount']);
                    }

                    $clone['paymentDetails']['responses']['efs'] = new EFS(...$clone['paymentDetails']['responses']['efs']);
                }

                $clone['paymentDetails']['responses'] = new PaymentDetailResponse(...$clone['paymentDetails']['responses']);
            }

            $checkout->setPaymentDetails(
                new PaymentDetail(...$clone['paymentDetails'])
            );
        }

        return $checkout;
    }
}
