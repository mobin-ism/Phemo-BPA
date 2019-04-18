<?php

namespace App\Imports;

use App\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class CustomersIndividualImport implements ToModel, WithHeadingRow
{
    protected $customer_type;

    public function __construct($customer_type)
    {
        $this->customer_type = $customer_type;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
            'customer_type' => $this->customer_type,
            'customer_name' => $row['customer_name'],
            'surname' => $row['surname'],
            'email' => $row['email'],
            'telephone' => $row['telephone'],
            'fax' => $row['fax'],
            'id_number' => $row['id_number_or_passport_number'],
            'address_line_1' => $row['address_line_1'],
            'address_line_2' => $row['address_line_2'],
            'city' => $row['city'],
            'zip_code' => $row['zip_code'],
            'country_id' => $row['country_id'],
            'facebook' => $row['facebook'],
            'twitter' => $row['twitter'],
            'linkedin' => $row['linkedin'],
            'skype' => $row['skype'],
            'account_id' => Auth::user()->account_id
        ]);
    }
}
