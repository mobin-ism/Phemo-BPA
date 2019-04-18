<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel, WithHeadingRow
{
    protected $user_type;
    protected $customer_type;

    public function __construct($user_type)
    {
        if ($user_type == 'individual' || $user_type == 'company') {
            $this->user_type = 'customer';
            $this->customer_type = $user_type;
        } else {
            $this->user_type = $user_type;
        }
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($this->user_type == 'customer') {
            if ($this->customer_type == 'company') {
                return new User([
                    'name' => $row['primary_contact'],
                    'email' => $row['email'],
                    'role' => 'customer',
                    'account_id' => Auth::user()->account_id
                ]);
            } else {
                return new User([
                    'name' => $row['customer_name'],
                    'email' => $row['email'],
                    'role' => 'customer',
                    'account_id' => Auth::user()->account_id
                ]);
            }
        }
    }
}