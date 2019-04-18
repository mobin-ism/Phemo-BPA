<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Quote;
use App\Product;
use App\Service;
use App\Invoice;
use App\Customer;
use App\PaymentMethod;
use Validator;
use PDF;
use App\Notifications\CustomerQuoteNotification;
use Notification;

class QuoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'employee') {
            $quotes = Quote::where('account_id', Auth::user()->account_id)->orderBy('issue_date', 'desc')->get();
        } else if (Auth::user()->role == 'customer') {
            $customer_id = \App\Customer::where('user_id', Auth::user()->id)->first()->id;
            $quotes = Quote::where('customer_id', $customer_id)->orderBy('issue_date', 'desc')->get();
        }
        return view('backend.pages.quotes.index',compact('quotes'));
    }

    public function create()
    {
        return view('backend.pages.quotes.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required'
        ]);

        if ($validator->passes()) {
            if ($request->item[0] != null) {
                $quote = new Quote;
                $quote->account_id = $request->account_id;
                $quote->customer_id = $request->customer_id;
                $quote->employee_id = $request->employee_id;
                $quote->quote_no = $request->quote_no;
                $quote->po_no = $request->po_no;
                $quote->issue_date = timestamp($request->issue_date);
                $quote->expiry_date = timestamp($request->expiry_date);
                $quote->shipping_charge = $request->shipping_charge;
                $quote->grand_total = $request->grand_total;
                $quote->notes = $request->notes;
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
                    $quote->items = json_encode($items);
                }
                $quote->save();
                return redirect()->route('quotes.index')->with('success','success_msg');
            } else {
                return redirect()->back()->with('error', 'item_error');
            }
        }
        return redirect()->back()->withErrors($validator);
    }

    public function show(Quote $quote)
    {
        return view('backend.pages.quotes.show', compact('quote'));
    }

    public function edit(Quote $quote)
    {
        return view('backend.pages.quotes.edit', compact('quote'));
    }

    public function update(Request $request, Quote $quote)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required'
        ]);

        if ($validator->passes()) {
            $quote = Quote::find($quote->id);
            $quote->account_id = $request->account_id;
            $quote->customer_id = $request->customer_id;
            $quote->employee_id = $request->employee_id;
            $quote->quote_no = $request->quote_no;
            $quote->po_no = $request->po_no;
            $quote->issue_date = timestamp($request->issue_date);
            $quote->expiry_date = timestamp($request->expiry_date);
            $quote->shipping_charge = $request->shipping_charge;
            $quote->grand_total = $request->grand_total;
            $quote->notes = $request->notes;
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
                $quote->items = json_encode($items);
            }
            $quote->save();
            return redirect()->route('quotes.index')->with('success','success_msg');
        }
        return response()->json(['errors' => $validator->errors()]);
    }

    public function destroy()
    {

    }

    public function delete($id)
    {
        Quote::destroy($id);
        return redirect()->back()->with('success','delete_msg');
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
        return view('backend.pages.quotes.entry', compact('type', 'info', 'count'));
    }

    public function get_blank_entry(Request $request)
    {
        $count = $request->itemRow;
        return view('backend.pages.quotes.entry', compact('count'));
    }

    public function filter(Request $request)
    {
        $match_cases = [
            'account_id' => $request->account_id
        ];
        if ($request->customer_id != null)
            $match_cases = array_merge($match_cases, ['customer_id' => $request->customer_id]);
        if ($request->employee_id != null)
            $match_cases = array_merge($match_cases, ['employee_id' => $request->employee_id]);
        if ($request->status != null)
            $match_cases = array_merge($match_cases, ['status' => $request->status]);
        if ($request->issue_date != null) {
            $issue_date = explode(' - ', $request->issue_date);
            $issue_start = timestamp($issue_date[0]);
            $issue_end = timestamp($issue_date[1]);
            $match_cases = array_merge($match_cases, [['issue_date', '>=', $issue_start], ['issue_date', '<=', $issue_end]]);
        }
        if ($request->expiry_date != null) {
            $expiry_date = explode(' - ', $request->expiry_date);
            $expiry_start = timestamp($expiry_date[0]);
            $expiry_end = timestamp($expiry_date[1]);
            $match_cases = array_merge($match_cases, [['expiry_date', '>=', $expiry_start], ['expiry_date', '<=', $expiry_end]]);
        }
        $filtered_quotes = Quote::where($match_cases)->get();
        return view('backend.pages.quotes.list', compact('filtered_quotes'));
    }

    public function make_invoice($id)
    {
        $quote = Quote::find($id);
        return view('backend.pages.quotes.make_invoice', compact('quote'));
    }

    public function save_invoice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'invoice_no' => 'required',
            'issue_date' => 'required',
            'due_date' => 'required'
        ]);

        if ($validator->passes()) {
            $invoice = new Invoice;
            $invoice->account_id = $request->account_id;
            $invoice->customer_id = $request->customer_id;
            $invoice->employee_id = $request->employee_id;
            $invoice->quote_id = $request->quote_id;
            $invoice->invoice_no = $request->invoice_no;
            $invoice->po_no = $request->po_no;
            $invoice->issue_date = timestamp($request->issue_date);
            $invoice->due_date = timestamp($request->due_date);
            $invoice->shipping_charge = $request->shipping_charge;
            $invoice->grand_total = $request->grand_total;
            $invoice->notes = $request->notes;
            $invoice->status = $request->status;
            $invoice->recurring = $request->recurring;
            $invoice->items = $request->items;
            if ($request->has('tax_invoice')) {
                $invoice->tax_invoice = $request->tax_invoice;
            }
            $invoice->save();
            // update the quote too
            $quote = Quote::find($request->quote_id);
            $quote->customer_id = $request->customer_id;
            $quote->po_no = $request->po_no;
            $quote->shipping_charge = $request->shipping_charge;
            $quote->grand_total = $request->grand_total;
            $quote->notes = $request->notes;
            $quote->status = 'invoiced';
            $quote->save();
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors' => $validator->errors()]);
    }

    public function download($id)
    {
        $quote = Quote::where('id', $id)->first();
        $pdf = PDF::loadView('pdf.quote', compact('quote'));
        return $pdf->download(get_config('quotation_prefix').'-'.$quote->quote_no.'.pdf');
    }

    public function send_email_to_customer($quote_id)
    {
        $quote = Quote::find($quote_id);
        if ($quote->status == 'pending') {
            $quote->status = 'active';
            $quote->save();
        }
        $customer_email = Customer::where('id', $quote->customer_id)->first()->email;
        Notification::route('mail', $customer_email)->notify(new CustomerQuoteNotification($quote_id, TRUE));
        return redirect()->back()->with('success', 'mail_success');
    }
}
