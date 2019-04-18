<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    protected $table = 'statements';
    protected $fillable = ['code', 'account_id', 'customer_id', 'start', 'end', 'status'];
}
