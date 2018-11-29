<?php

namespace App\Services;
use App\PaymentYear;
use App\Interfaces\PaymentYearInterface;

class PaymentYearService implements PaymentYearInterface
{

    public function getAllPaymentYears(): array
    {
        return PaymentYear::all()->toArray();
    }

    public function createPaymentYear(array $arr)
    {
        //TODO: Set studio student and studio teacher as well
        $paymentYear = new PaymentYear([
            'year' => $arr['year'],
            'January' => $arr['January'],
            'February' => $arr['February'],
            'March' => $arr['March'],
            'April' => $arr['April'],
            'May' => $arr['May'],
            'June' => $arr['June'],
            'July' => $arr['July'],
            'August' => $arr['August'],
            'September' => $arr['September'],
            'October' => $arr['October'],
            'November' => $arr['November'],
            'December' => $arr['December'],
            'teacher' => $arr['teacher'],
            'student' => $arr['student'],
        ]);

        $paymentYear->save();
    }

    public function deletePaymentYear(int $id)
    {
        $paymentYear = PaymentYear::find($id);
        $paymentYear->delete();
    }

}