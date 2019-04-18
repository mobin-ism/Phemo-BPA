<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\ExpenseType;
use App\Tax;
use Auth;
use Validator;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $expenses = Expense::where('account_id', Auth::user()->account_id)->orderBy('date', 'desc')->get();
        return view('backend.pages.expenses.index',compact('expenses'));
    }

    public function create()
    {
        return view('backend.pages.expenses.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'expense_type_id' => 'required',
            'amount' => 'required|numeric',
            'tax_amount' => 'nullable|numeric',
            'tip' => 'nullable|numeric',
            'paid_through' => 'required',
            'reference' => 'required',
            'attachment' => 'mimes:pdf,jpg|max:3000|nullable'
        ]);

        if ($validator->passes()) {
            $expense = new Expense;
            $expense->account_id = $request->account_id;
            $expense->date = timestamp($request->date);
            $expense->expense_type_id = $request->expense_type_id;
            $expense->amount = $request->amount;
            $expense->tax_amount = $request->tax_amount;
            $expense->tip = $request->tip;
            $expense->total = ($request->amount + $request->tip + $request->tax_amount);
            $expense->paid_through = $request->paid_through;
            $expense->reference = $request->reference;
            $expense->vendor_id = $request->vendor_id;
            $expense->customer_id = $request->customer_id;
            $expense->notes = $request->notes;
            if ($request->attachment != null) {
                $attachment = $request->file('attachment');
                $extension = $attachment->getClientOriginalExtension();
                $attachment_name = $request->reference . '.' . $extension;
                $path = $attachment->storeAs('expense-receipts/'.$request->account_id, $attachment_name);
                $expense->attachment = $path;
            }
            $expense->save();
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function show(Expense $expense)
    {
        return view('backend.pages.expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        return view('backend.pages.expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'expense_type_id' => 'required',
            'amount' => 'required|numeric',
            'tax_amount' => 'nullable|numeric',
            'tip' => 'nullable|numeric',
            'paid_through' => 'required',
            'reference' => 'required',
            'attachment' => 'mimes:pdf,jpg|max:3000|nullable'
        ]);

        if ($validator->passes()) {
            $expense->account_id = $request->account_id;
            $expense->date = timestamp($request->date);
            $expense->expense_type_id = $request->expense_type_id;
            $expense->amount = $request->amount;
            $expense->tax_amount = $request->tax_amount;
            $expense->tip = $request->tip;
            $expense->total = ($request->amount + $request->tip + $request->tax_amount);
            $expense->paid_through = $request->paid_through;
            $expense->reference = $request->reference;
            $expense->vendor_id = $request->vendor_id;
            $expense->customer_id = $request->customer_id;
            $expense->notes = $request->notes;
            if ($request->attachment != null) {
                $attachment = $request->file('attachment');
                $extension = $attachment->getClientOriginalExtension();
                $attachment_name = $request->reference . '.' . $extension;
                $path = $attachment->storeAs('expense-receipts/'.$request->account_id, $attachment_name);
                $expense->attachment = $path;
            }
            $expense->save();
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function delete($id)
    {
        Expense::destroy($id);
        return redirect()->route('expenses.index')->with('success','delete_msg');
    }

    public function dynamic_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'add_name' => 'required'
        ]);

        if ($validator->passes()) {
            if ($request->add_type == 'expense_type_id') {
                $expense_type = new ExpenseType;
                $expense_type->name = $request->add_name;
                $expense_type->account_id = Auth::user()->account_id;
                $expense_type->save();
                return response()->json(['success' => '1', 'expense_type_id' => $expense_type->id, 'name' => $expense_type->name, 'type' => 'expense_type']);
            }
        }
        return response()->json(['errors'=>$validator->errors()]);
    }

    public function filter(Request $request)
    {
        $match_cases = [
            'account_id' => $request->account_id
        ];
        if ($request->expense_type_id != null)
            $match_cases = array_merge($match_cases, ['expense_type_id' => $request->expense_type_id]);
        if ($request->date != null) {
            $date = explode(' - ', $request->date);
            $date_start = timestamp($date[0]);
            $date_end = timestamp($date[1]);
            $match_cases = array_merge($match_cases, [['date', '>=', $date_start], ['date', '<=', $date_end]]);
        }
        $filtered_expenses = Expense::where($match_cases)->get();
        return view('backend.pages.expenses.list', compact('filtered_expenses'));
    }

    public function download($id)
    {
        $filePath = Expense::where('id', $id)->first()->attachment;
        return response()->download(storage_path('app/'.$filePath));
    }
}