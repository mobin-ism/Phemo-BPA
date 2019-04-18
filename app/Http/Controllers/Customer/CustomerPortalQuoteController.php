<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Quote;
use App\Customer;
use Notification;
use App\Notifications\CustomerQuoteNotification;
use PDF;

class CustomerPortalQuoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer');
    }

    public function quotes()
    {
        $customer_id = Customer::where('user_id', Auth::user()->id)->first()->id;
        $quotes = Quote::where('customer_id', $customer_id)->orderBy('issue_date', 'desc')->get();
        return view('backend.customers.quotes.index', compact('quotes'));
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
        $filtered_quotes = Quote::where($match_cases)->orderBy('issue_date', 'desc')->get();
        return view('backend.customers.quotes.list', compact('filtered_quotes'));
    }

    public function show($id)
    {
        $customer_id = Customer::where('user_id', Auth::user()->id)->first()->id;
        $quote = Quote::where('id', $id)->first();
        if ($quote->customer_id == $customer_id) {
            return view('backend.customers.quotes.show', compact('quote'));
        } else {
            abort(404);
        }
    }

    public function edit($id)
    {
        $customer_id = Customer::where('user_id', Auth::user()->id)->first()->id;
        $quote = Quote::where('id', $id)->first();
        if ($quote->customer_id == $customer_id) {
            return view('backend.customers.quotes.edit', compact('quote'));
        } else {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $quote = Quote::find($id);
        $items = [];
        // saving items as json
        if ($request->has('item') && $request->item != null) {
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
        return redirect()->back()->with('success','success_msg');
    }

    public function approve($id)
    {
        $customer_id = Customer::where('user_id', Auth::user()->id)->first()->id;
        $quote = Quote::where('id', $id)->first();
        if ($quote->customer_id == $customer_id) {
            $quote->status = 'approved';
            $quote->save();
            if ($quote->employee_id == null) {
                $admin = \App\User::where(['account_id' => $quote->account_id, 'role' => 'admin'])->first()->email;
                Notification::route('mail', $admin)->notify(new CustomerQuoteNotification($id, FALSE));
            } else {
                $employee = \App\Employee::where('id', $quote->employee_id)->first()->user_id;
                $employee_email = \App\User::where('id', $employee)->first()->email;
                Notification::route('mail', $employee_email)->notify(new CustomerQuoteNotification($id, FALSE));
            }
            return redirect()->back()->with('success', 'quote_approved');
        } else {
            abort(404);
        }
    }

    public function reject($id)
    {
        $customer_id = Customer::where('user_id', Auth::user()->id)->first()->id;
        $quote = Quote::where('id', $id)->first();
        if ($quote->customer_id == $customer_id) {
            $quote->status = 'rejected';
            $quote->save();
            if ($quote->employee_id == null) {
                $admin = \App\User::where(['account_id' => $quote->account_id, 'role' => 'admin'])->first()->email;
                Notification::route('mail', $admin)->notify(new CustomerQuoteNotification($id, FALSE));
            } else {
                $employee = \App\Employee::where('id', $quote->employee_id)->first()->user_id;
                $employee_email = \App\User::where('id', $employee)->first()->email;
                Notification::route('mail', $employee_email)->notify(new CustomerQuoteNotification($id, FALSE));
            }
            return redirect()->back()->with('success', 'quote_rejected');
        } else {
            abort(404);
        }
    }

    public function download($id)
    {
        $customer_id = Customer::where('user_id', Auth::user()->id)->first()->id;
        $quote = Quote::where('id', $id)->first();
        if ($quote->customer_id == $customer_id) {
            $pdf = PDF::loadView('pdf.quote', compact('quote'));
            return $pdf->download(get_config('quotation_prefix').'-'.$quote->quote_no.'.pdf');
        } else {
            abort(404);
        }
    }
}