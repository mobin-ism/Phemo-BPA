<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Invoice;
use App\Product;
use App\Service;
use App\PaymentMethod;
use App\Payment;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\Config;
use Validator;
use Notification;
use App\Notifications\NewInvoicePayment;
use App\Notifications\CustomerInvoice;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'employee') {
            $invoices = Invoice::where('account_id', Auth::user()->account_id)->orderBy('issue_date', 'desc')->get();
        } else if (Auth::user()->role == 'customer') {
            $customer_id = Customer::where('user_id', Auth::user()->id)->first()->id;
            $invoices = Invoice::where('customer_id', $customer_id)->orderBy('issue_date', 'desc')->get();
        }
        return view('backend.pages.invoices.index', compact('invoices'));
    }

    public function create()
    {
        return view('backend.pages.invoices.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'invoice_no' => 'required'
        ]);

        if ($validator->passes()) {
            if ($request->item[0] != null) {
                $invoice = new Invoice;
                $invoice->account_id = $request->account_id;
                $invoice->customer_id = $request->customer_id;
                $invoice->employee_id = $request->employee_id;
                $invoice->invoice_no = $request->invoice_no;
                $invoice->po_no = $request->po_no;
                $invoice->issue_date = timestamp($request->issue_date);
                $invoice->due_date = timestamp($request->due_date);
                $invoice->shipping_charge = $request->shipping_charge;
                $invoice->grand_total = $request->grand_total;
                $invoice->notes = $request->notes;
                $invoice->status = $request->status;
                $invoice->recurring = $request->recurring;
                $items = [];
                // saving items as json
                if ($request->has('item')) {
                    foreach ($request->item as $key => $entry) {
                        $itemTypeId = explode('-', $request->item[$key]);
                        $data['id'] = $itemTypeId[1];
                        $data['type'] = $itemTypeId[0];
                        $data['description'] = $request->description[$key];
                        $data['uom'] = $request->uom[$key];
                        $data['qty'] = $request->qty[$key];
                        $data['price'] = $request->price[$key];
                        $data['discount'] = $request->discount[$key];
                        $data['tax'] = $request->tax[$key];
                        $data['tax_id'] = $request->tax_id[$key];
                        $data['total'] = $request->total[$key];
                        array_push($items, $data);
                    }
                    $invoice->items = json_encode($items);
                }
                if ($request->has('tax_invoice')) {
                    $invoice->tax_invoice = $request->tax_invoice;
                }
                $invoice->save();
                return redirect()->route('invoices.index')->with('success','success_msg');
            } else {
                return redirect()->back()->with('error', 'item_error');
            }
        }
        return redirect()->back()->withErrors($validator);
    }

    
    public function show(Invoice $invoice)
    {
        return view('backend.pages.invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        return view('backend.pages.invoices.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'invoice_no' => 'required'
        ]);

        if ($validator->passes()) {
            $invoice->account_id = $request->account_id;
            $invoice->customer_id = $request->customer_id;
            $invoice->employee_id = $request->employee_id;
            $invoice->invoice_no = $request->invoice_no;
            $invoice->po_no = $request->po_no;
            $invoice->issue_date = timestamp($request->issue_date);
            $invoice->due_date = timestamp($request->due_date);
            $invoice->shipping_charge = $request->shipping_charge;
            $invoice->grand_total = $request->grand_total;
            $invoice->notes = $request->notes;
            $invoice->status = $request->status;
            $invoice->recurring = $request->recurring;
            $items = [];
            // saving items as json
            if ($request->has('item')) {
                foreach ($request->item as $key => $entry) {
                    $itemTypeId = explode('-', $request->item[$key]);
                    $data['id'] = $itemTypeId[1];
                    $data['type'] = $itemTypeId[0];
                    $data['description'] = $request->description[$key];
                    $data['uom'] = $request->uom[$key];
                    $data['qty'] = $request->qty[$key];
                    $data['price'] = $request->price[$key];
                    $data['discount'] = $request->discount[$key];
                    $data['tax'] = $request->tax[$key];
                    $data['tax_id'] = $request->tax_id[$key];
                    $data['total'] = $request->total[$key];
                    array_push($items, $data);
                }
                $invoice->items = json_encode($items);
            }
            if ($request->has('tax_invoice')) {
                $invoice->tax_invoice = $request->tax_invoice;
            }
            $invoice->save();
            return redirect()->route('invoices.index')->with('success','success_msg');
        }
        return response()->json(['errors' => $validator->errors()]);
    }

    public function destroy($id)
    {
        //
    }


    public function delete($id)
    {
        Invoice::destroy($id);
        return redirect()->back()->with('success','delete_msg');
    }

    public function download($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $pdf = PDF::loadView('pdf.invoice', compact('invoice'));
        return $pdf->download(get_config('invoice_prefix').'-'.$invoice->invoice_no.'.pdf');
    }

    public function preview($id)
    {
        
    }

    public function get_item_info(Request $request)
    {
        $item = $request->item;
        $item = explode('-', $item);
        $type = $item[0];
        $id = $item[1];
        $count = $request->itemRow;
        if ($type == 'service') {
            $info = Service::find($id);
        } else {
            $info = Product::find($id);
        }
        return view('backend.pages.invoices.entry', compact('type', 'info', 'count'));
    }

    public function get_blank_entry(Request $request)
    {
        $count = $request->itemRow;
        return view('backend.pages.invoices.entry', compact('count'));
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
        $filtered_invoices = Invoice::where($match_cases)->get();
        return view('backend.pages.invoices.list', compact('filtered_invoices'));
    }

    public function dynamic_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'add_name' => 'required'
        ]);
        if ($validator->passes()) {
            if ($request->add_type == 'payment_method_id') {
                $method = new PaymentMethod;
                $method->name = $request->add_name;
                $method->account_id = Auth::user()->account_id;
                $method->save();
                return response()->json(['success' => '1', 'payment_method_id' => $method->id, 'name' => $method->name, 'type' => 'method']);
            }
        }
        return response()->json(['errors'=>$validator->errors()]);
    }

    public function payment($id)
    {
        $invoice = Invoice::find($id);
        return view('backend.pages.invoices.payment', compact('invoice'));
    }

    public function record_payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'date' => 'required',
            'payment_method_id' => 'required',
            'reference' => 'required'
        ]);

        if ($validator->passes()) {
            $payment = new Payment;
            $payment->invoice_id = $request->invoice_id;
            $payment->account_id = Auth::user()->account_id;
            $payment->type = 'invoice';
            $payment->amount = $request->amount;
            $payment->date = timestamp($request->date);
            $payment->reference = $request->reference;
            $payment->notes = $request->notes;
            $payment->payment_method_id = $request->payment_method_id;
            $payment->save();
            // calculate due and update invoice status accordingly
            $invoice = Invoice::find($request->invoice_id);
            $paid = $this->calculate_payments($invoice->id);
            $grand_total = $invoice->grand_total;
            if ($paid < $grand_total) {
                $invoice->status = 'partially_paid';
                $invoice->save();
            } else if ($paid == $grand_total) {
                $invoice->status = 'paid';
                $invoice->save();
            }
            $customer_email = \App\Customer::where('id', $invoice->customer_id)->first()->email;
            Notification::route('mail', $customer_email)->notify(new NewInvoicePayment($request, $paid));
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors' => $validator->errors()]);
    }

    public function calculate_payments($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);
        $payments = Payment::where('invoice_id', $invoice->id)->get();
        $amount_paid = 0;
        foreach ($payments as $payment)
            $amount_paid += $payment->amount;
        return $amount_paid;
    }

    public function delete_payment($id, $invoice_id)
    {
        Payment::destroy($id);
        $invoice = Invoice::find($invoice_id);
        $total_paid = $this->calculate_payments($invoice_id);
        $due = $invoice->grand_total - $total_paid;
        if ($due == 0) {
            $invoice->status = 'paid';
            $invoice->save();
        } else if ($due < $invoice->grand_total && $due != 0) {
            $invoice->status = 'partially_paid';
            $invoice->save();
        } else if ($due == $invoice->grand_total) {
            $invoice->status = 'unpaid';
            $invoice->save();
        }
        return redirect()->back()
            ->with('success','delete_msg');
    }

    public function receipt($id)
    {
        $payment = Payment::find($id);
        $invoice = Invoice::find($payment->invoice_id);
        return view('backend.pages.invoices.receipt', compact('payment', 'invoice'));
    }

    public function send_email_to_customer($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $customer_email = \App\Customer::where('id', $invoice->customer_id)->first()->email;
        Notification::route('mail', $customer_email)->notify(new CustomerInvoice($id));
        return redirect()->back()->with('success', 'mail_success');
    }
}
