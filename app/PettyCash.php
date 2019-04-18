<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PettyCash extends Model
{
    //
    protected $fillable = [
        'date', 'department', 'requested_by', 'amount', 'voucher_no', 'description', 'status', 'changed_by', 'account_id'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
