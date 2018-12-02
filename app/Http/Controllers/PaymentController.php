<?php

namespace App\Http\Controllers;
use App\Interfaces\PaymentInterface;
use App\Interfaces\CommentInterface;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $pyi = null;

    public function __construct(PaymentInterface $pyi)
    {
        $this->pyi = $pyi;
    }

    public function getAllPayments()
    {
        return $this->pyi->getAllPayments();
    }

    public function getAllPaymentsAndComments()
    {
        return $this->pyi->getAllPaymentsAndComments();
    }

    public function createPayment(Request $request)
    {
        $payment = [
            'amount' => $request->amount,
            'student' => $request->student,
            'teacher' => $request->teacher
        ];

        $this->pyi->createPayment($payment);
    }

    public function editPayment(Request $request)
    {
        $edits = [
            'id' => $request->id,
            'amount' => $request->amount
        ];

        $this->pyi->editPayment($edits);
    }

    public function deletePayment(Request $request)
    {
        $id = $request->id;
        $this->pyi->deletePayment($id);
    }

}
