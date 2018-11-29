<?php

namespace App\Services;
use App\PaymentYear;
use App\Interfaces\PaymentYearInterface;

class PaymentYearService implements PaymentYearInterface
{

    public function getAllPaymentYears(): array
    {
        return PaymentYear::all()->toArray();
    }
}