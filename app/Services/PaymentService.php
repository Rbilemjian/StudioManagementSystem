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

    public function createPayment(array $arr)
    {
        $date = \Carbon\Carbon::now()->toDateString();
        $payment = new Payment([
            'amount' => $arr['amount'],
            'teacher' => $arr['teacher'],
            'student' => $arr['student'],
            'date' => $date
        ]);
        $payment->save();
    }

    public function deletePayment(int $id)
    {
        $Payment = Payment::find($id);
        $Payment->delete();
    }

}