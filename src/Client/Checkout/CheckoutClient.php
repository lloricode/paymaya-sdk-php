<?php

declare(strict_types=1);

namespace Lloricode\Paymaya\Client\Checkout;

use Lloricode\Paymaya\Client\BaseClient;
use Lloricode\Paymaya\Request\Checkout\Checkout;
use Lloricode\Paymaya\Response\Checkout\CheckoutResponse;

class CheckoutClient extends BaseClient
{
    public static function uri(int $uriVersion = 1): string
    {
        return "checkout/v$uriVersion/checkouts";
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException|\Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function execute(Checkout $checkoutRequest): CheckoutResponse
    {
        $response = $this->publicPost(['json' => $checkoutRequest]);

        $body = json_decode((string) $response->getBody(), true);

        return new CheckoutResponse($body);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException|\Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function retrieve(string $id): Checkout
    {
        $response = $this->secretGet($id);

        $body = json_decode($response->getBody()->getContents(), true);

        return new Checkout($body);
//        $checkout = (new Checkout($body));
//            ->setId($body['id'])
//            ->setRequestReferenceNumber($body['requestReferenceNumber'])
//            ->setReceiptNumber($body['receiptNumber'] ?? null)
//            ->setCreatedAt(Carbon::parse($body['createdAt']))
//            ->setUpdatedAt(Carbon::parse($body['updatedAt']))
//            ->setExpressCheckout($body['expressCheckout'])
//            ->setRefundedAmount($body['refundedAmount'])
//            ->setCanPaypal($body['canPayPal'])
//            ->setStatus($body['status'])
//            ->setPaymentStatus($body['paymentStatus']);
//
//        // TODO: "paymentDetails": {},
//
        ////        $checkout->setBuyerRequest(
        ////            (new BuyerRequest())
        ////                ->setContactRequest((new ContactRequest())
        ////                ->setPhone($body->))
        ////        );
//
//
//        foreach ($body['items'] ?? [] as $item) {
//            $itemRequest = new ItemRequest();
//
//            $itemRequest->setName($item['name'])
//                ->setQuantity($item['quantity'])
//                ->setCode($item['code'] ?? null)
//                ->setDescription($item['description']);
//
//            $itemRequest->setAmountRequest(
//                (new AmountRequest())
//                    ->setValue($item['amount']['value'])
//                    ->setAmountRequest(
//                        (new AmountDetailRequest())
//                            ->setDiscount($item['amount']['details']['discount'])
//                            ->setServiceCharge($item['amount']['details']['serviceCharge'])
//                            ->setShippingFee($item['amount']['details']['shippingFee'])
//                            ->setTax($item['amount']['details']['tax'])
//                            ->setSubtotal($item['amount']['details']['subtotal'])
//                    )
//            );
//
//            $itemRequest->setTotalAmountRequest(
//                (new AmountRequest())
//                    ->setValue($item['totalAmount']['value'])
//                    ->setAmountRequest(
//                        (new AmountDetailRequest())
//                            ->setDiscount($item['totalAmount']['details']['discount'])
//                            ->setServiceCharge($item['totalAmount']['details']['serviceCharge'])
//                            ->setShippingFee($item['totalAmount']['details']['shippingFee'])
//                            ->setTax($item['totalAmount']['details']['tax'])
//                            ->setSubtotal($item['totalAmount']['details']['subtotal'])
//                    )
//            );
//
//            $checkout->addItemRequest($itemRequest);
//        }
//
//        $checkout->setMetaDataRequest(
//            (new MetaDataRequest())
//                ->setMCI($body['metadata']['smi'])
//                ->setSMN($body['metadata']['smn'])
//                ->setMCI($body['metadata']['mci'])
//                ->setMPC($body['metadata']['mpc'])
//                ->setMCO($body['metadata']['mco'])
//                ->setMST($body['metadata']['mst'])
//        );

//        return $checkout;
    }
}
