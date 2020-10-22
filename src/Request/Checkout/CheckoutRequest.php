<?php

namespace Lloricode\Paymaya\Request\Checkout;

use Lloricode\Paymaya\Request\BaseRequest;
use Lloricode\Paymaya\Request\Checkout\Buyer\BuyerRequest;

/**
 * https://hackmd.io/@paymaya-pg/Checkout
 * https://developers.paymaya.com/blog/entry/paymaya-checkout-api-overview
 */
class CheckoutRequest extends BaseRequest
{
    private ?string $id = null;
    private TotalAmountRequest $total_amount_request;
    private ?BuyerRequest $buyer_request = null;

    /**
     * @var \Lloricode\Paymaya\Request\Checkout\ItemRequest[]
     */
    private array $items = [];
    private ?RedirectUrlRequest $redirect_url_request = null;
    private ?string $status = null;
    private ?string $payment_status = null;
    private string $request_reference_number;
    private MetaDataRequest $meta_data_request;

    public function setTotalAmountRequest(TotalAmountRequest $totalAmountRequest): self
    {
        $this->total_amount_request = $totalAmountRequest;

        return $this;
    }

    public function setBuyerRequest(?BuyerRequest $buyerRequest): self
    {
        $this->buyer_request = $buyerRequest;

        return $this;
    }

    public function addItemRequest(ItemRequest $itemRequest): self
    {
        $this->items[] = $itemRequest;

        return $this;
    }

    public function setRedirectUrlRequest(?RedirectUrlRequest $redirectUrlRequest): self
    {
        $this->redirect_url_request = $redirectUrlRequest;

        return $this;
    }

    public function setRequestReferenceNumber(string $requestReferenceNumber): self
    {
        $this->request_reference_number = $requestReferenceNumber;

        return $this;
    }

    public function setMetaDataRequest(MetaDataRequest $metaDataRequest): self
    {
        $this->meta_data_request = $metaDataRequest;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'totalAmount' => $this->total_amount_request,
            'buyer' => $this->buyer_request,
            'items' => $this->items,
            'redirectUrl' => $this->redirect_url_request,
            'requestReferenceNumber' => $this->request_reference_number,
            'metadata' => $this->meta_data_request,
            'status' => $this->status,
            'paymentStatus' => $this->payment_status,
        ];
    }
}
