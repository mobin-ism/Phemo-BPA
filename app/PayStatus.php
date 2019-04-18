<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayStatus extends Model
{
    protected $table = 'pay_statuses';

    protected $fillable = [
        'name', 'account_id'
    ];
}