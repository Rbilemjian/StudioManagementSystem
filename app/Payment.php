<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount',
        'student',
        'teacher',
        'date'
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment', 'payment_id', 'id');
    }
}
