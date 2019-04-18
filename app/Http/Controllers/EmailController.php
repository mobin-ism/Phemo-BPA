<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\QuotationEmailManager;
use Mail;
use App\Invoice;
use App\Quotation;
use App\PurchaseOrder;
use PDF;
use App\Config;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    //

    public function __construct()
    {
        //$config = Config::where('account_id', Auth::user()->account_id)->first();
    }

    public function sendQuotationEmail($id)
    {
    	$quotation = Quotation::find($id);
        
        if($config->template_version == 1){
            $pdf = PDF::loadView('pdf.template-1.quotation', compact('quotation'));
        }
        else{
            $pdf = PDF::loadView('pdf.template-2.quotation', compact('quotation'));
        }
    	
		$output = $pdf->output();
		file_put_contents('Quotation-'.$quotation->code.'.pdf', $output);

    	Mail::send('email.quotation', ['quotation' => $quotation], function ($m) use ($quotation, $pdf) {
            $m->from('mehedi.iitdu@gmail.com', 'Phemo');
            $m->to($quotation->customer->email, $quotation->customer->customer_name)->subject('Quotation #'.$quotation->code);
            $m->attach('Quotation-'.$quotation->code.'.pdf',[
		            'as' => 'Quotation-'.$quotation->code.'pdf', 
		            'mime' => 'application/pdf'
		        ]);
        });

        return redirect()->route('quotations.list')
            ->with('success','Quotation has been emailed to the customer successfully');
    }

    public function sendInvoiceEmail($id)
    {
    	$invoice = Invoice::find($id);
    	if($config->template_version == 1){
            $pdf = PDF::loadView('pdf.template-1.invoice', compact('invoice'));
        }
        else{
            $pdf = PDF::loadView('pdf.template-2.invoice', compact('invoice'));
        }
		$output = $pdf->output();
		file_put_contents('Invoice-'.$invoice->invoice_no.'.pdf', $output);

    	Mail::send('email.invoice', ['invoice' => $invoice], function ($m) use ($invoice) {
            $m->from('mehedi.iitdu@gmail.com', 'Phemo');
            $m->to($invoice->customer->email, $invoice->customer->customer_name)->subject('Invoice #'.$invoice->invoice_no);
            $m->attach('Invoice-'.$invoice->invoice_no.'.pdf',[
		            'as' => 'Invoice-'.$invoice->invoice_no.'pdf', 
		            'mime' => 'application/pdf'
		        ]);
        });

        return redirect()->route('invoices.list')
            ->with('success','Invoice has been emailed to the customer successfully');
    }

    public function sendPoEmail($id)
    {
    	$purchase_order = PurchaseOrder::find($id);
    	if($config->template_version == 1){
            $pdf = PDF::loadView('pdf.template-1.purchase_order', compact('purchase_order'));
        }
        else{
            $pdf = PDF::loadView('pdf.template-2.purchase_order', compact('purchase_order'));
        }
		$output = $pdf->output();
		file_put_contents('Purchase Order-'.$purchase_order->po.'.pdf', $output);

    	Mail::send('email.po', ['purchase_order' => $purchase_order], function ($m) use ($purchase_order) {
            $m->from('mehedi.iitdu@gmail.com', 'Phemo');
            $m->to($purchase_order->customer->email, $purchase_order->customer->customer_name)->subject('Purchase Order #'.$purchase_order->po);
            $m->attach('Purchase Order-'.$purchase_order->po.'.pdf',[
		            'as' => 'Purchase Order-'.$purchase_order->po.'.pdf', 
		            'mime' => 'application/pdf'
		        ]);
        });

        return redirect()->route('purchase_orders.list')
            ->with('success','Purchase Order has been emailed to the customer successfully');
    }
}
