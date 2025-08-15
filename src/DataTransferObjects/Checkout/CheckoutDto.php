<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout;

use ErrorException;
use Lloricode\Paymaya\DataTransferObjects\BaseDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Amount\AmountDetailDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Buyer\BillingAddressDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Buyer\BuyerDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Buyer\ContactDto;
use Lloricode\Paymaya\DataTransferObjects\Checkout\Buyer\ShippingAddressDto;
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
 * @method self setId(string|int $id)
 * @method self setTotalAmount(TotalAmountDto $totalAmount)
 * @method self setBuyer(BuyerDto $buyer)
 * @method self setRedirectUrl(RedirectUrlDto $redirectUrl)
 * @method self setStatus(string $status)
 * @method self setPaymentStatus(string $paymentStatus)
 * @method self setRequestReferenceNumber(string $requestReferenceNumber)
 * @method self setMetadata(MetaDataDto $metadata)
 * @method self setReceiptNumber(string $receiptNumber)
 * @method self setCreatedAt(string $createdAt)
 * @method self setUpdatedAt(string $updatedAt)
 * @method self setExpiredAt(string $expiredAt)
 * @method self setExpressCheckout(bool $expressCheckout)
 * @method self setRefundedAmount(float|string|int $refundedAmount)
 * @method self setCanPayPal(bool $canPayPal)
 * @method self setPaymentScheme(string $paymentScheme)
 * @method self setMerchant(MerchantDto $merchant)
 * @method self setPaymentDetails(PaymentDetail $paymentDetails)
 * @method self setTransactionReferenceNumber(string $transactionReferenceNumber)
 */
class CheckoutDto extends BaseDto
{
    public function __construct(
        public string|int|null $id = null,
        public ?TotalAmountDto $totalAmount = null,
        public ?BuyerDto $buyer = null,

        /** @var \Lloricode\Paymaya\DataTransferObjects\Checkout\ItemDto[] */
        public array $items = [],
        public ?RedirectUrlDto $redirectUrl = null,
        public ?string $status = null,
        public ?string $paymentStatus = null,
        public ?string $requestReferenceNumber = null,
        public ?MetaDataDto $metadata = null,

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
        public ?MerchantDto $merchant = null,
        public ?PaymentDetail $paymentDetails = null,
        public ?string $transactionReferenceNumber = null,
    ) {
        $this->totalAmount ??= new TotalAmountDto;
    }

    #[\Override]
    public function __call(string $name, mixed $arguments): static
    {
        if ($name === 'setItems') {
            throw new ErrorException(sprintf('%s::%s() not found.', static::class, $name));
        }

        return parent::__call($name, $arguments);
    }

    public function addItem(ItemDto $itemRequest): self
    {
        $this->items[] = $itemRequest;

        return $this;
    }

    public static function fromArray(array $data): static
    {
        $clone = $data;
        unset(
            $data['metadata'],
            $data['totalAmount'],
            $data['buyer'],
            $data['redirectUrl'],
            $data['merchant'],
            $data['paymentDetails'],
        );

        /** @phpstan-ignore-next-line  */
        $checkout = new static(...$data);

        unset($data);

        if (isset($clone['metadata'])) {
            $checkout->setMetadata(new MetaDataDto(...$clone['metadata']));
        }

        if (isset($clone['totalAmount'])) {
            $tmp = $clone['totalAmount'];

            unset($tmp['details']);
            $totalAmount = new TotalAmountDto(...$tmp);
            unset($tmp);

            if (isset($clone['totalAmount']['details'])) {
                $totalAmount->setDetails(
                    new AmountDetailDto(...$clone['totalAmount']['details'])
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
            $buyer = new BuyerDto(...$tmp);
            unset($tmp);

            if (isset($clone['buyer']['contact'])) {
                $buyer->setContact(new ContactDto(...$clone['buyer']['contact']));
            }

            if (isset($clone['buyer']['shippingAddress'])) {
                $buyer->setShippingAddress(new ShippingAddressDto(...$clone['buyer']['shippingAddress']));
            }

            if (isset($clone['buyer']['billingAddress'])) {
                $buyer->setBillingAddress(new BillingAddressDto(...$clone['buyer']['billingAddress']));
            }

            $checkout->setBuyer(
                $buyer
            );
        }

        if (isset($clone['redirectUrl'])) {
            $checkout->setRedirectUrl(
                new RedirectUrlDto(...$clone['redirectUrl'])
            );
        }

        if (isset($clone['merchant'])) {
            $checkout->setMerchant(
                new MerchantDto(...$clone['merchant'])
            );
        }

        if (isset($clone['paymentDetails'])) {
            $clone['paymentDetails']['is3ds'] = $clone['paymentDetails']['3ds'] ?? false;
            unset($clone['paymentDetails']['3ds']);

            if ($clone['paymentDetails']['responses'] ?? false) {
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
