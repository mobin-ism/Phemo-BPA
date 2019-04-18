<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
    	'company_name',
        'invoice_prefix',
	    'quotation_prefix',
	    'po_prefix',
	    'voucher_prefix',
	    'date_format',
	    'currency',
	    'template_version',
	    'template_color',
	    'text_color',
	    'invoice_email',
	    'quotation_email',
	    'po_email',
	    'tc_invoice',
	    'tc_quotation',
	    'tc_po',
	    'account_id'
    ];
}
