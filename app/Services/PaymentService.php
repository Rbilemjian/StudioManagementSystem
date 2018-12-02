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

    public function getAllPayments(): array
    {
        return Payment::all()->toArray();
    }

    public function getAllPaymentsAndComments(): array
    {
        return Payment::with('comments')->get()->toArray();
    }

    public function createPayment(array $arr)
    {
        $date = \Carbon\Carbon::now()->toDateString();
        $payment = new Payment([
            'amount' => $arr['amount'],
            'notes' => $arr['notes'],
            'teacher' => $arr['teacher'],
            'student' => $arr['student'],
            'date' => $date
        ]);
        $payment->save();
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
