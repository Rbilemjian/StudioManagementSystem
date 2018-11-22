<?php

namespace App\Services;
use App\Payment;
use App\Interfaces\PaymentInterface;

class PaymentService implements PaymentInterface
{

    public function getAllPayments(): array
    {
        return Payment::all()->toArray();
    }
}