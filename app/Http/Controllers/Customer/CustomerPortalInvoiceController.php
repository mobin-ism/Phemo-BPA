<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Invoice;
use App\Customer;
use App\Payment;
use PDF;

class CustomerPortalInvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer');
    }

    public function invoices()
    {
        $customer_id = Customer::where('user_id', Auth::user()->id)->first()->id;
        $invoices = Invoice::where('customer_id', $customer_id)->orderBy('issue_date', 'desc')->get();
        return view('backend.customers.invoices.index', compact('invoices'));
    }

    public function filter(Request $request)
    {
        $match_cases = [
            'account_id' => $request->account_id
        ];
        if ($request->customer_id != null)
            $match_cases = array_merge($match_cases, ['customer_id' => $request->customer_id]);
        if ($request->status != null)
            $match_cases = array_merge($match_cases, ['status' => $request->status]);
        if ($request->issue_date != null) {
            $issue_date = explode(' - ', $request->issue_date);
            $issue_start = timestamp($issue_date[0]);
            $issue_end = timestamp($issue_date[1]);
            $match_cases = array_merge($match_cases, [['issue_date', '>=', $issue_start], ['issue_date', '<=', $issue_end]]);
        }
        if ($request->due_date != null) {
            $due_date = explode(' - ', $request->due_date);
            $due_start = timestamp($due_date[0]);
            $due_end = timestamp($due_date[1]);
            $match_cases = array_merge($match_cases, [['due_date', '>=', $due_start], ['due_date', '<=', $due_end]]);
        }
        $filtered_invoices = Invoice::where($match_cases)->orderBy('issue_date', 'desc')->get();
        return view('backend.customers.invoices.list', compact('filtered_invoices'));
    }

    public function show($id)
    {
        $customer_id = Customer::where('user_id', Auth::user()->id)->first()->id;
        $invoice = Invoice::where('id', $id)->first();
        if ($invoice->customer_id == $customer_id) {
            return view('backend.customers.invoices.show', compact('invoice'));
        } else {
            abort(404);
        }
    }

    public function receipt($id)
    {
        $payment = Payment::where('id', $id)->first();
        $invoice = Invoice::where('id', $payment->invoice_id)->first();
        $customer_id = Customer::where('user_id', Auth::user()->id)->first()->id;
        if ($invoice->customer_id == $customer_id) {
            return view('backend.customers.invoices.receipt', compact('payment', 'invoice'));
        } else {
            abort(404);
        }
    }

    public function download($id)
    {
        $customer_id = Customer::where('user_id', Auth::user()->id)->first()->id;
        $invoice = Invoice::where('id', $id)->first();
        if ($invoice->customer_id == $customer_id) {
            $pdf = PDF::loadView('pdf.invoice', compact('invoice'));
            return $pdf->download(get_config('invoice_prefix').'-'.$invoice->invoice_no.'.pdf');
        } else {
            abort(404);
        }
    }
}