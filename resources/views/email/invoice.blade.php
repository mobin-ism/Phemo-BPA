@php
	$message = \App\Config::first()->invoice_email;

	$message = str_replace('[INVOICE_NO]', $invoice->invoice_no, $message);
	$message = str_replace('[PO]', $invoice->po, $message);
	$message = str_replace('[INVOICE_DATE]', date('d-m-Y', $invoice->invoice_date), $message);
	$message = str_replace('[DUE_DATE]', date('d-m-Y', $invoice->due_date), $message);
	$message = str_replace('[CUSTOMER_NAME]', $invoice->customer->customer_name, $message);
	
	echo $message;
@endphp