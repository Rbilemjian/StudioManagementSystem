<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount',
        'payed_by',
        'payed_to',
        'date',
        'notes'
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment', 'payment_id', 'id');
    }
}
