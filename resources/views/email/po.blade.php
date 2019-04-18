@php
	$message = \App\Config::first()->po_email;

	$message = str_replace('[PO_NO]', $purchase_order->po, $message);
	$message = str_replace('[PR]', $purchase_order->po, $message);
	$message = str_replace('[DATE]', date('d-m-Y', $purchase_order->date), $message);
	$message = str_replace('[PURPOSE]', $purchase_order->purpose, $message);
	$message = str_replace('[REQUEST_TYPE]', $purchase_order->request_type, $message);
	$message = str_replace('[CUSTOMER_NAME]', $purchase_order->customer->customer_name, $message);
	
	echo $message;
@endphp