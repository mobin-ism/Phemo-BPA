<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Statement;
use App\Customer;

class CustomerPortalStatementController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer');
    }

    public function statements()
    {
        $customer_id = Customer::where('user_id', Auth::user()->id)->first()->id;
        $statements = Statement::where('customer_id', $customer_id)->orderBy('created_at', 'desc')->get();
        return view('backend.customers.statements.index', compact('statements'));
    }

    public function show($id)
    {
        $customer_id = Customer::where('user_id', Auth::user()->id)->first()->id;
        $statement = Statement::where('id', $id)->first();
        $customer_info = Customer::where('id', $statement->customer_id)->first();
        $match_cases = [
            'customer_id' => $statement->customer_id
        ];
        $match_cases = array_merge($match_cases, [['due_date', '>=', $statement->start], ['due_date', '<=', $statement->end]]);
        if ($statement->status == 'paid') {
            $invoices = \App\Invoice::where([
                ['customer_id', $statement->customer_id],
                ['due_date', '>=', $statement->start],
                ['due_date', '<=', $statement->end],
                ['status', 'paid']
            ])->get();
        }  else if ($statement->status == 'unpaid') {
            $invoices = \App\Invoice::where([
                ['customer_id', $statement->customer_id],
                ['due_date', '>=', $statement->start],
                ['due_date', '<=', $statement->end],
                ['status', 'unpaid']
            ])->orWhere('status', 'partially_paid')->get();
        } else {
            $invoices = \App\Invoice::where($match_cases)->get();
        }
        if ($customer_id == $customer_info->id) {
            return view('backend.customers.statements.show', compact('statement', 'invoices', 'customer_info'));
        } else {
            abort(404);
        }
    }
}