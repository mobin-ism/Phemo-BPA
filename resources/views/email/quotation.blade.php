@php
	$message = \App\Config::first()->quotation_email;

	$message = str_replace('[CODE]', $quotation->code, $message);
	$message = str_replace('[CUSTOMER_NAME]', $quotation->customer->customer_name, $message);
	$message = str_replace('[QUOTATION_DATE]', date('d-m-Y', $quotation->quotation_date), $message);
	$message = str_replace('[DUE_DATE]', date('d-m-Y', $quotation->valid_till), $message);
	$message = str_replace('[SHIPPING_ADDRESS]', $quotation->shipping_address, $message);
	
	echo $message;
@endphp