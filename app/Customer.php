<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'customer_type', 'company_name', 'primary_contact', 'customer_name', 'surname', 'email', 'website', 'telephone', 'id_number', 'fax',
        'address_line_1', 'address_line_2', 'country_id', 'city', 'zip_code', 'vat_no', 'user_id', 'account_id', 'facebook', 'twitter', 'linkedin',
        'skype', 'customer_category_id', 'customer_no'
    ];


    public function account()
    {
        return $this->belongsTo('App/Account');
    }

    public function user()
    {
        return $this->belongsTo('App/User');
    }

    public function invoices(){
        return $this->hasMany('App/Invoice');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}
