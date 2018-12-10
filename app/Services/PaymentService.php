<?php

namespace App\Services;
use App\Payment;
use App\Interfaces\PaymentInterface;
use App\Interfaces\CommentInterface;

class PaymentService implements PaymentInterface
{

    public function getAllPayments()
    {
        $payments = Payment::orderBy('created_at', 'desc')->get();
        return response()->json([
            "payments" => $payments
        ], 200);
    }

    public function getPayment(int $id)
    {
        $payment = Payment::where('id','=',$id)->first();
        return response()->json([
            "payment" => $payment
        ], 200);
    }

    public function createPayment(array $arr)
    {
        $date = \Carbon\Carbon::now()->toDateString();
        $payment = new Payment([
            'amount' => $arr['amount'],
            'notes' => $arr['notes'],
            'payed_to' => $arr['payed_to'],
            'payed_by' => $arr['payed_by'],
            'date' => $date
        ]);
        $payment->save();

        return response()->json([
            "payment" => $payment
        ], 200);
    }

    public function deletePayment(int $id)
    {
        $Payment = Payment::where('id','=',$id);
        $Payment->delete();
    }

}
