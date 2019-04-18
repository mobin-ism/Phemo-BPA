<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name', 'code', 'purchase_price', 'sales_price', 'quantity', 'unit_of_measure_id', 'description', 'account_id'
    ];

    public function account()
    {
        return $this->belongsTo('App/Service');
    }

    public function unit_of_measure()
    {
        return $this->belongsTo(UnitOfMeasure::class);
    }
}
