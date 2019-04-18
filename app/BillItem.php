<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillItem extends Model
{
    protected $fillable = [
        'item_type', 'item_id', 'expense_type_id', 'uom', 'qty', 'price', 'discount', 'tax', 'total'
    ];
}
