<?php

namespace App\Interfaces;

Interface PaymentYearInterface
{
    public function getAllPaymentYears(): array;
    public function createPaymentYear(array $arr);
}