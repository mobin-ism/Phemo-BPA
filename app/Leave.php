<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    //
    protected $fillable = [
        'leave_type', 'requested_by', 'department', 'start_date', 'end_date', 'attachments', 'status', 'changed_by', 'account_id'
    ];
}
