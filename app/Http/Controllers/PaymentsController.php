<?php

namespace App\Http\Controllers;
use App\Interfaces\PaymentInterface;

use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    protected $pi = null;
    public function __construct(PaymentInterface $pi)
    {
        $this->pi = $pi;
    }
    public function getAllPayments()
    {
        return $this->pi->getAllPayments();
    }
}
