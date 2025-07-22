<?php

namespace App\Billing;

class PaymentGateway
{
    private $currency;
    private $discount = 0;

    public function __construct($currency)
    {
        $this->currency = $currency;
    }


    public function charge($amount)
    {
        return [
            'currency' => $this->currency,
            'charge' => $amount - $this->discount,
            'discount' => $this->discount,
        ];
    }

    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }
}
