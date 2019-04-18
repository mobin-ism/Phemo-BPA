<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use Auth;
use Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewTicket;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'employee') {
            $tickets = Ticket::where('account_id', Auth::user()->account_id)->orderBy('created_at', 'desc')->get();
        } else if (Auth::user()->role == 'customer') {
            $customer_id = \App\Customer::where('user_id', Auth::user()->id)->first()->id;
            $tickets = Ticket::where('customer_id', $customer_id)->orderBy('created_at', 'desc')->get();
        }
        return view('backend.pages.tickets.index',compact('tickets'));
    }


    public function list()
    {     

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            $customer_email = \App\Customer::where('id', $request->customer_id)->first()->email;
            Ticket::create($request->all());
            Notification::route('mail', $customer_email)->notify(new NewTicket($request));
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('backend.pages.tickets.show',compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        return view('backend.pages.tickets.edit',compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'subject' => 'required',
            'title' => 'required',
            'priority' => 'required',
            'employee_id' => 'required',
            'resolve_status' => 'required',
            'description' => 'required'
        ]);

        if ($validator->passes()) {
            $ticket->update($request->all());
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        Ticket::destroy($id);
        return redirect()->route('tickets.index')
            ->with('success','delete_msg');
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
        $filtered_tickets = Ticket::where($match_cases)->get();
        return view('backend.pages.tickets.list', compact('filtered_tickets'));
    }
}
