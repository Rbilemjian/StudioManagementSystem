<?php

namespace App\Http\Controllers;
use App\Interfaces\PaymentYearInterface;

use Illuminate\Http\Request;

class PaymentYearController extends Controller
{
    protected $pyi = null;

    public function __construct(PaymentYearInterface $pyi)
    {
        $this->pyi = $pyi;
    }

    public function getAllPaymentYears()
    {
        return $this->pyi->getAllPaymentYears();
    }

    public function createPaymentYear(Request $request)
    {
        $paymentYear = [
            'year' => $request->year,
            'January' => $request->January,
            'February' => $request->February,
            'March' => $request->March,
            'April' => $request->April,
            'May' => $request->May,
            'June' => $request->June,
            'July' => $request->July,
            'August' => $request->August,
            'September' => $request->September,
            'October' => $request->October,
            'November' => $request->November,
            'December' => $request->December,
            'student' => $request->student,
            'teacher' => $request->teacher 
        ];

        $this->pyi->createPaymentYear($paymentYear);
    }

    public function deletePaymentYear(Request $request)
    {
        $id = $request->id;
        $this->pyi->deletePaymentYear($id);
    }

}
