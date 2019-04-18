<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
