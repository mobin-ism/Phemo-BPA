<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $fillable = [
	    'name', 'percentage', 'account_id'
	];
}
