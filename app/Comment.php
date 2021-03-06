<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'payment_id',
        'user',
        'text',
    ];

    public function payment()
    {
        $this->belongsTo('App\Payment');
    }

}
