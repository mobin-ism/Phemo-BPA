<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalCost extends Model
{
	protected $fillable = [
		'name', 'unit_price', 'unit', 'account_id'
	];
}
