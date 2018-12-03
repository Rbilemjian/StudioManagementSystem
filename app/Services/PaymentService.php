<?php

namespace App\Services;
use App\Payment;
use App\Interfaces\PaymentInterface;
use App\Interfaces\CommentInterface;

class PaymentService implements PaymentInterface
{

    protected $ci = null;
    public function __construct(CommentInterface $ci)
    {
        $this->ci = $ci;
    }

    public function getAllPayments()
    {
        $payments = Payment::all();
        return response()->json([
            "payments" => $payments
        ], 200);
    }

    public function getPaymentAndComments(int $id)
    {
        $payment = Payment::where('id','=',$id)->first();
        $comments = $this->ci->getPostComments($id);
        return response()->json([
            "payment" => $payment,
            "comments" => $comments
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

    public function editPayment(array $edits)
    {
        $payment = Payment::find($edits['id']);
        $payment->amount = $edits['amount'];
        $payment->notes = $edits['notes'];
        $payment->save();
    }

    public function deletePayment(int $id)
    {
        $Payment = Payment::find($id);
        $Payment->delete();
    }

}
