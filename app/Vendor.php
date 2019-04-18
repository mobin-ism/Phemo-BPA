<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{

    protected $fillable = [
        'name', 'contact_person', 'company_phone', 'contact_email', 'work_number', 'cell_phone', 'skype_id',
        'address_line_1', 'address_line_2', 'city', 'zip_code', 'tax_number', 'swift_code', 'iban', 'country_id', 'state', 'website', 'user_id', 'account_id'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
