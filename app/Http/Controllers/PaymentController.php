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

    public function getPayment(Request $request)
    {
        $id = $request->id;
        return $this->pyi->getPayment($id);
    }

    public function getPaymentAndComments(Request $request)
    {
        $id = $request->id;
        return $this->pyi->getPaymentAndComments($id);
    }

    public function createPayment(Request $request)
    {
        $payment = [
            'amount' => $request->amount,
            'notes' => $request->notes,
            'payed_by' => $request->payed_by,
            'payed_to' => $request->payed_to
        ];

        $this->pyi->createPayment($payment);
    }

    public function editPayment(Request $request)
    {
        $edits = [
            'id' => $request->id,
            'amount' => $request->amount,
            'notes' => $request->notes,
        ];

        $this->pyi->editPayment($edits);
    }

    public function deletePayment(Request $request)
    {
        $id = $request->id;
        $this->pyi->deletePayment($id);
    }

}
