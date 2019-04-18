<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
    	'name', 'code', 'description', 'rate', 'unit_of_measure_id', 'account_id'
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
