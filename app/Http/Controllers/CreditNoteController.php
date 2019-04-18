<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\CreditNote;
use App\Invoice;

class CreditNoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $credit_notes = CreditNote::where('account_id', Auth::user()->account_id)->get();
        return view('backend.pages.credit_notes.index', compact('credit_notes'));
    }

    public function create()
    {
        return view('backend.pages.credit_notes.create');
    }

    public function store(Request $request)
    {

    }

    public function edit(CreditNote $credit_note)
    {

    }

    public function update(Request $request, CreditNote $credit_note)
    {

    }

    public function destroy()
    {

    }
}
