<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\DamagedProduct;
use Validator;
use Illuminate\Support\Facades\Auth;

class DamagedProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $damaged_products = DamagedProduct::where('account_id', Auth::user()->account_id)->orderBy('created_at', 'desc')->get();
        return view('backend.pages.damaged_products.index', compact('damaged_products'));
    }

    public function create()
    {
        return view('backend.pages.damaged_products.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|numeric',
            'notes' => 'required'
        ]);

        if ($validator->passes()) {
            $damaged_product = new DamagedProduct;
            $damaged_product->account_id = $request->account_id;
            $damaged_product->date = timestamp($request->date);
            $damaged_product->product_id = $request->product_id;
            $damaged_product->quantity = $request->quantity;
            $damaged_product->notes = $request->notes;
            if ($request->has('reduce')) {
                $product = Product::where(['account_id' => Auth::user()->account_id, 'id' => $request->product_id])->first();
                $stock = $product->quantity;
                $stock = $stock - $request->quantity;
                $product->quantity = $stock;
                $product->save();
            }
            $damaged_product->save();
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function edit($id)
    {
        $damaged_product = DamagedProduct::find($id);
        return view('backend.pages.damaged_products.edit', compact('damaged_product'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|numeric',
            'notes' => 'required'
        ]);

        if ($validator->passes()) {
            $damaged_product = DamagedProduct::find($id);
            $damaged_product->account_id = $request->account_id;
            $damaged_product->date = timestamp($request->date);
            $damaged_product->product_id = $request->product_id;
            $damaged_product->quantity = $request->quantity;
            $damaged_product->notes = $request->notes;
            if ($request->has('reduce')) {
                $product = Product::where(['account_id' => Auth::user()->account_id, 'id' => $request->product_id])->first();
                $stock = $product->quantity;
                $stock = $stock - $request->quantity;
                $product->quantity = $stock;
                $product->save();
            }
            $damaged_product->save();
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
    }

    public function destroy()
    {

    }

    public function delete($id)
    {
        DamagedProduct::destroy($id);
        return redirect()->route('damaged_products.index')->with('success','delete_msg');
    }

    public function filter(Request $request)
    {
        $match_cases = [
            'account_id' => $request->account_id
        ];
        if ($request->product_id != null)
            $match_cases = array_merge($match_cases, ['product_id' => $request->product_id]);
        if ($request->date != null) {
            $date = explode(' - ', $request->date);
            $date_start = timestamp($date[0]);
            $date_end = timestamp($date[1]);
            $match_cases = array_merge($match_cases, [['date', '>=', $date_start], ['date', '<=', $date_end]]);
        }
        $filtered_products = DamagedProduct::where($match_cases)->get();
        return view('backend.pages.damaged_products.list', compact('filtered_products'));
    }
}
