<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'vendor_id', 'po', 'pr', 'request_type', 'purpose', 'date', 'products', 'services', 'grand_total', 'payments',
        'account_id', 'status', 'remarks', 'tc'
    ];

    public function account(){
    	return $this->belongsTo(Account::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
