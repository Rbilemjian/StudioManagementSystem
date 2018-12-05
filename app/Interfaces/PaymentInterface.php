<?php

namespace App\Interfaces;

Interface PaymentInterface
{
    public function getAllPayments();
    public function getPayment(int $id);
    public function getPaymentAndComments(int $id);
    public function createPayment(array $arr);
    public function editPayment(array $arr);
    public function deletePayment(int $id);
}
