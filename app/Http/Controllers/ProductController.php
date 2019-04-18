<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\UnitOfMeasure;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Imports\ProductsImport;

class ProductController extends Controller
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
        $products = Product::where('account_id', Auth::user()->account_id)->get();
        return view('backend.pages.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.products.create');
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
            'code' => 'required|unique:products,code',
            'name' => 'required',
            'purchase_price' => 'nullable|numeric',
            'sales_price' => 'required|numeric',
            'quantity' => 'nullable|numeric'
        ]);

        if ($validator->passes()) {
            Product::create($request->all());
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
    public function show(Product $product)
    {
        return view('backend.pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('backend.pages.products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
            'purchase_price' => 'nullable|numeric',
            'sales_price' => 'required|numeric',
            'quantity' => 'nullable|numeric'
        ]);

        if ($validator->passes()) {
            $product->update($request->all());
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
        Product::destroy($id);
        return redirect()->route('products.index')
            ->with('success','delete_msg');
    }


    public function dynamic_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'add_name' => 'required'
        ]);
        if ($validator->passes()) {
            if ($request->add_type == 'unit_of_measure_id') {
                $uom = new UnitOfMeasure;
                $uom->name = $request->add_name;
                $uom->account_id = Auth::user()->account_id;
                $uom->save();
                return response()->json(['success' => '1', 'unit_of_measure_id' => $uom->id, 'name' => $uom->name, 'type' => 'uom']);
            }
        }
        return response()->json(['errors'=>$validator->errors()]);
    }

    public function pdf()
    {
        $products = Product::where('account_id', Auth::user()->account_id)->get();
        $pdf = PDF::loadView('backend.pages.products.exports.products', compact('products'));
        return $pdf->download('products-' . get_config('company_name') . '-' . time() . '.pdf');
    }

    public function excel()
    {
        $account_id = Auth::user()->account_id;
        return (new ProductsExport($account_id))->download('products-' . get_config('company_name') . '-' . time() . '.xlsx');
    }

    public function import_excel()
    {
        return view('backend.pages.products.import');
    }

    public function import(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'attachment' => 'required'
        ]);

        if ($validator->passes()) {
            $attachment = $request->file('attachment');
            $extension = $attachment->getClientOriginalExtension();
            if ($extension == 'xlsx') {
                $attachment_name ='products-'. random_code(7) . '.' . $extension;
                $path = $attachment->storeAs('/', $attachment_name);
                Excel::import(new ProductsImport, $attachment_name);
                unlink(storage_path('app/' . $path));
                return redirect()->route('products.index')->with('success','success_msg');
            }
            return back();
        }
        return back();
    }

    public function download_sample_excel()
    {
        return response()->download(storage_path('app/samples/products.xlsx'));
    }
}
