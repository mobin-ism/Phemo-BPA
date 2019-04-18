<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerCategory extends Model
{
    protected $table = 'customer_categories';
    
    protected $fillable = ['name', 'account_id'];
}
