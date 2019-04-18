<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryHead extends Model
{
    protected $table = 'salary_heads';

    protected $fillable = [
        'name', 'type', 'account_id'
    ];
}