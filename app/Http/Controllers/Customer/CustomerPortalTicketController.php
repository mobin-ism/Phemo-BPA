<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Ticket;
use App\Customer;
use Validator;
use Notification;
use App\Notifications\NewTicket;

class CustomerPortalTicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer');
    }

    public function tickets()
    {
        $customer_id = Customer::where('user_id', Auth::user()->id)->first()->id;
        $tickets = Ticket::where('customer_id', $customer_id)->orderBy('created_at', 'desc')->get();
        return view('backend.customers.tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('backend.customers.tickets.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'subject' => 'required',
            'title' => 'required',
            'priority' => 'required',
            'resolve_status' => 'required',
            'description' => 'required'
        ]);

        if ($validator->passes()) {
            $customer_email = Customer::where('id', $request->customer_id)->first()->email;
            Ticket::create($request->all());
            Notification::route('mail', $customer_email)->notify(new NewTicket($request));
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors'=>$validator->errors()]);
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
        if ($request->priority != null)
            $match_cases = array_merge($match_cases, ['priority' => $request->priority]);
        if ($request->resolve_status != null)
            $match_cases = array_merge($match_cases, ['resolve_status' => $request->resolve_status]);
        $filtered_tickets = Ticket::where($match_cases)->orderBy('created_at', 'desc')->get();
        return view('backend.customers.tickets.list', compact('filtered_tickets'));
    }

    public function show($id)
    {
        $customer_id = Customer::where('user_id', Auth::user()->id)->first()->id;
        $ticket = Ticket::where('id', $id)->first();
        if ($ticket->customer_id == $customer_id) {
            return view('backend.customers.tickets.show', compact('ticket'));
        } else {
            abort(404);
        }
    }
}