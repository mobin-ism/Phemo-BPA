<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobStatus extends Model
{
    protected $table = 'job_statuses';

    protected $fillable = [
        'name', 'account_id'
    ];
}