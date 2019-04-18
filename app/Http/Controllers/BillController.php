<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Bill;
use App\Product;
use App\Service;
use App\Payment;
use App\BillItem;
use App\PaymentMethod;
use Validator;
use PDF;

class BillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'employee') {
            $bills = Bill::where('account_id', Auth::user()->account_id)->orderBy('created_at', 'desc')->get();
        } else if (Auth::user()->role == 'vendor') {
            $vendor_id = \App\Vendor::where('user_id', Auth::user()->id)->first()->id;
            $bills = Bill::where('vendor_id', $vendor_id)->orderBy('created_at', 'desc')->get();
        }
        return view('backend.pages.bills.index',compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.bills.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vendor_id' => 'required',
            'shipping_charge' => 'nullable|numeric',
            'attachment' => 'mimes:pdf,jpg|max:5000'
        ]);

        if ($validator->passes()) {
            if ($request->item[0] != null) {
                $bill = new Bill;
                $bill->account_id = $request->account_id;
                $bill->vendor_id = $request->vendor_id;
                $bill->bill_no = $request->bill_no;
                $bill->po_no = $request->po_no;
                $bill->bill_date = timestamp($request->bill_date);
                $bill->po_date = timestamp($request->po_date);
                $bill->due_date = timestamp($request->due_date);
                $bill->shipping_charge = $request->shipping_charge;
                $bill->grand_total = $request->grand_total;
                // saving attachment
                if ($request->has('attachment')) {
                    $attachment = $request->file('attachment');
                    $extension = $attachment->getClientOriginalExtension();
                    $attachment_name = $request->bill_no . '.' . $extension;
                    $path = $attachment->storeAs('bill-attachments/'.$request->account_id, $attachment_name);
                    $bill->attachment = $path;
                }
                $bill->save();
                // saving items to bill items table
                if ($request->has('item')) {
                    foreach ($request->item as $key => $entry) {
                        $item = new BillItem;
                        $item->bill_id = $bill->id;
                        $itemTypeId = explode('-', $request->item[$key]);
                        $item->item_type = $itemTypeId[0];
                        $item->item_id = $itemTypeId[1];
                        $item->expense_type_id = $request->expense_type_id[$key];
                        $item->uom = $request->uom[$key];
                        $item->qty = $request->qty[$key];
                        $item->price = $request->price[$key];
                        $item->discount = $request->discount[$key];
                        $item->tax = $request->tax[$key];
                        $item->tax_id = $request->tax_id[$key];
                        $item->total = $request->total[$key];
                        $item->save();
                    }
                }
                return redirect()->route('bills.index')->with('success','success_msg');
            } else {
                return redirect()->back()->with('error', 'item_error');
            }
        }
        return redirect()->back()->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
        return view('backend.pages.bills.show', compact('bill'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        return view('backend.pages.bills.edit', compact('bill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        $validator = Validator::make($request->all(), [
            'vendor_id' => 'required',
            'shipping_charge' => 'nullable|numeric',
            'attachment' => 'mimes:pdf,jpg|max:5000'
        ]);

        if ($validator->passes()) {
            $bill->account_id = $request->account_id;
            $bill->vendor_id = $request->vendor_id;
            $bill->bill_no = $request->bill_no;
            $bill->po_no = $request->po_no;
            $bill->bill_date = timestamp($request->bill_date);
            $bill->po_date = timestamp($request->po_date);
            $bill->due_date = timestamp($request->due_date);
            $bill->grand_total = $request->grand_total;
            $bill->discount_percentage = $request->discount_percentage;
            $bill->status = $request->status;
            // saving attachment
            if ($request->has('attachment')) {
                $attachment = $request->file('attachment');
                $extension = $attachment->getClientOriginalExtension();
                $attachment_name = $request->bill_no . '-.' . $extension;
                $path = $attachment->storeAs('bill-attachments/'.$request->account_id, $attachment_name);
                $bill->attachment = $path;
            }
            $bill->save();
            return redirect()->route('bills.index')->with('success','success_msg');
        }
        return response()->json(['errors' => $validator->errors()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function delete($id)
    {
        
    }

    public function get_blank_entry(Request $request)
    {
        $count = $request->itemRow;
        return view('backend.pages.bills.partials.entry', compact('count'));
    }

    public function get_items(Request $request)
    {
        $type = $request->type;
        $count = $request->itemRow;
        if ($type == 'service') {
            $items = Service::where('account_id', Auth::user()->account_id)->get();
        } else {
            $items = Product::where('account_id', Auth::user()->account_id)->get();
        }
        return view('backend.pages.bills.partials.entry', compact('items', 'type', 'count'));
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
        return view('backend.pages.bills.partials.entry', compact('type', 'info', 'count'));
    }

    public function payment($id)
    {
        $bill = Bill::find($id);
        return view('backend.pages.bills.payment', compact('bill'));
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
            $payment->bill_id = $request->bill_id;
            $payment->account_id = Auth::user()->account_id;
            $payment->type = 'bill';
            $payment->amount = $request->amount;
            $payment->date = timestamp($request->date);
            $payment->reference = $request->reference;
            $payment->notes = $request->notes;
            $payment->payment_method_id = $request->payment_method_id;
            $payment->save();
            // calculate due and update bill status accordingly
            $bill = Bill::find($request->bill_id);
            $paid = $this->calculate_payments($bill->id);
            $grand_total = $bill->grand_total;
            if ($paid < $grand_total) {
                $bill->status = 1;
                $bill->save();
            } else if ($paid == $grand_total) {
                $bill->status = 2;
                $bill->save();
            }

            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors' => $validator->errors()]);
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

    public function delete_payment($id, $bill_id)
    {
        Payment::destroy($id);
        $bill = Bill::find($bill_id);
        $total_paid = $this->calculate_payments($bill_id);
        $due = $bill->grand_total - $total_paid;
        if ($due == 0) {
            $bill->status = 2;
            $bill->save();
        } else if ($due < $bill->grand_total && $due != 0) {
            $bill->status = 1;
            $bill->save();
        } else if ($due == $bill->grand_total) {
            $bill->status = 0;
            $bill->save();
        }
        return redirect()->back()
            ->with('success','delete_msg');
    }

    public function calculate_payments($bill_id)
    {
        $bill = Bill::find($bill_id);
        $payments = Payment::where('bill_id', $bill->id)->get();
        $amount_paid = 0;
        foreach ($payments as $payment)
            $amount_paid += $payment->amount;
        return $amount_paid;
    }

    public function download_attachment($bill_no)
    {
        $filePath = Bill::where('bill_no', $bill_no)->first()->attachment;
        return response()->download(storage_path('app/'.$filePath));
    }

    public function pdf($bill_id)
    {
        $bill = Bill::find($bill_id);
        $pdf = PDF::loadView('backend.pages.bills.partials.bill', compact('bill'));
        return $pdf->download($bill->bill_no.'.pdf');
    }

    public function filter(Request $request)
    {
        $match_cases = [
            'account_id' => $request->account_id
        ];
        if ($request->vendor_id != null)
            $match_cases = array_merge($match_cases, ['vendor_id' => $request->vendor_id]);
        if ($request->status != null)
            $match_cases = array_merge($match_cases, ['status' => $request->status]);
        if ($request->bill_date != null) {
            $bill_date = explode(' - ', $request->bill_date);
            $bill_start = timestamp($bill_date[0]);
            $bill_end = timestamp($bill_date[1]);
            $match_cases = array_merge($match_cases, [['bill_date', '>=', $bill_start], ['bill_date', '<=', $bill_end]]);
        }
        if ($request->due_date != null) {
            $due_date = explode(' - ', $request->due_date);
            $due_start = timestamp($due_date[0]);
            $due_end = timestamp($due_date[1]);
            $match_cases = array_merge($match_cases, [['due_date', '>=', $due_start], ['due_date', '<=', $due_end]]);
        }
        $filtered_bills = Bill::where($match_cases)->get();
        return view('backend.pages.bills.list', compact('filtered_bills'));
    }
}
