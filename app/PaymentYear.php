<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentYear extends Model
{
    protected $fillable = [
        'year',
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July'.
        'August',
        'September',
        'October',
        'November',
        'December',
        'student',
        'teacher',
    ];
}
