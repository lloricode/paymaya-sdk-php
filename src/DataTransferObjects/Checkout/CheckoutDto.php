<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\DataTransferObjects\Checkout;

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
 */
readonly class CheckoutDto extends BaseDto
{
    public function __construct(
        public string|int|null $id = null,
        public ?TotalAmountDto $totalAmount = new TotalAmountDto,
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
    ) {}

    public static function fromArray(array $data): static
    {
        $totalAmount = null;
        if (isset($data['totalAmount'])) {
            $ta = $data['totalAmount'];
            $details = null;

            if (isset($ta['details'])) {
                $details = new AmountDetailDto(...$ta['details']);
                unset($ta['details']);
            }
            $totalAmount = new TotalAmountDto(...$ta);
            if ($details !== null) {
                $totalAmount = new TotalAmountDto(
                    amount: $totalAmount->amount,
                    value: $totalAmount->value,
                    details: $details
                );
            }
        }

        $buyer = null;
        if (isset($data['buyer'])) {
            $bd = $data['buyer'];
            $contact = isset($bd['contact']) ? new ContactDto(...$bd['contact']) : null;
            $shipping = isset($bd['shippingAddress']) ? new ShippingAddressDto(...$bd['shippingAddress']) : null;
            $billing = isset($bd['billingAddress']) ? new BillingAddressDto(...$bd['billingAddress']) : null;

            unset($bd['contact'], $bd['shippingAddress'], $bd['billingAddress']);
            $buyer = new BuyerDto(...$bd);

            $buyer = new BuyerDto(
                firstName: $buyer->firstName ?? $data['firstName'] ?? null,
                middleName: $buyer->middleName ?? $data['middleName'] ?? null,
                lastName: $buyer->lastName ?? $data['lastName'] ?? null,
                contact: $contact ?? $buyer->contact ?? null,
                shippingAddress: $shipping ?? $buyer->shippingAddress ?? null,
                billingAddress: $billing ?? $buyer->billingAddress ?? null
            );
        }

        $paymentDetails = null;
        if (isset($data['paymentDetails'])) {
            $pd = $data['paymentDetails'];

            $pd['is3ds'] = $pd['3ds'] ?? false;
            unset($pd['3ds']);

            if (! empty($pd['responses'])) {
                $responses = $pd['responses'];

                if (isset($responses['efs'])) {
                    $efs = $responses['efs'];

                    if (isset($efs['receipt'])) {
                        $efs['receipt'] = new Receipt(...$efs['receipt']);
                    }

                    if (isset($efs['payer'])) {
                        $payer = $efs['payer'];

                        if (isset($payer['fundingInstrument'])) {
                            $fi = $payer['fundingInstrument'];

                            if (isset($fi['card'])) {
                                $fi['card'] = new Card(...$fi['card']);
                            }

                            $payer['fundingInstrument'] = new FundingInstrument(...$fi);
                        }

                        $efs['payer'] = new Payer(...$payer);
                    }

                    if (isset($efs['amount'])) {
                        $amt = $efs['amount'];

                        if (isset($amt['total'])) {
                            $amt['total'] = new Total(...$amt['total']);
                        }

                        $efs['amount'] = new Amount(...$amt);
                    }

                    $responses['efs'] = new EFS(...$efs);
                }

                $pd['responses'] = new PaymentDetailResponse(...$responses);
            }

            $paymentDetails = new PaymentDetail(...$pd);
        }

        /** @phpstan-ignore new.static */
        return new static(
            id: $data['id'] ?? null,
            totalAmount: $totalAmount ?? new TotalAmountDto,
            buyer: $buyer,
            items: $data['items'] ?? [],
            redirectUrl: new RedirectUrlDto(...($data['redirectUrl'] ?? [])),
            status: $data['status'] ?? null,
            paymentStatus: $data['paymentStatus'] ?? null,
            requestReferenceNumber: $data['requestReferenceNumber'] ?? null,
            metadata: new MetaDataDto(...($data['metadata'] ?? [])),
            receiptNumber: $data['receiptNumber'] ?? null,
            createdAt: $data['createdAt'] ?? null,
            updatedAt: $data['updatedAt'] ?? null,
            expiredAt: $data['expiredAt'] ?? null,
            expressCheckout: $data['expressCheckout'] ?? null,
            refundedAmount: $data['refundedAmount'] ?? 0,
            canPayPal: $data['canPayPal'] ?? null,
            paymentScheme: $data['paymentScheme'] ?? null,
            merchant: new MerchantDto(...($data['merchant'] ?? [])),
            paymentDetails: $paymentDetails,
            transactionReferenceNumber: $data['transactionReferenceNumber'] ?? null,
        );
    }
}
