<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    public function bill_payments()
    {
        return $this->hasMany(BillPayment::class);
    }

    public function bill_items()
    {
        return $this->hasMany(BillItem::class);
    }

}
