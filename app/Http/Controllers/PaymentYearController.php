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
    public function getAllPayments()
    {
        return $this->pyi->getAllPaymentYears();
    }
}
