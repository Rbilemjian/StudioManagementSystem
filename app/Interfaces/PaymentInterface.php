<?php

namespace App\Interfaces;

Interface PaymentInterface
{
    public function getAllPayments(): array;
    public function getAllPaymentsAndComments(): array;
    public function createPayment(array $arr);
    public function editPayment(array $arr);
    public function deletePayment(int $id);
}
