<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\PurchaseOrder;
use PDF;
use App\Config;

class PurchaseOrderController extends Controller
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
        return view('backend.pages.purchase_orders.index');
    }


    public function list()
    {

        $purchase_orders = PurchaseOrder::where('account_id', Auth::user()->account_id)->get();
        return view('backend.pages.purchase_orders.list',compact('purchase_orders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.purchase_orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $format = \App\Config::where('account_id', Auth::user()->account_id)->first()->date_format;

        if($format == 'd/m/Y'){
            $request->date = str_replace('/', '-', $request->date);
        }
        elseif($format == 'm-d-Y'){
            $request->date = str_replace('-', '/', $request->date);
        }

        $date = strtotime($request->date);
        $request->merge(array('date' => $date));
        $products = array();

        if($request->has('product_id'))
        {
            foreach($request->product_id as $key => $product_id)
            {
                $product = array();
                $product['id'] = $product_id;
                $product['qty'] = $request->product_qty[$key];
                //$product['discount'] = $request->product_discount[$key];
                //$product['tax'] = $request->product_tax[$key];

                array_push($products,$product);
            }
        }

        $services = array();

        if($request->has('service_id'))
        {
            foreach($request->service_id as $key => $service_id)
            {
                $service = array();
                $service['id'] = $service_id;
                $service['duration'] = $request->service_duration[$key];
                //$service['discount'] = $request->service_discount[$key];
                //$service['tax'] = $request->service_tax[$key];

                array_push($services,$service);
            }
        }

        $payments = array();

        PurchaseOrder::create(array_merge($request->all(), ['products' => json_encode($products)], ['services' => json_encode($services)], ['payments' => json_encode($payments)]));
        return redirect()->route('purchase_orders.index')
            ->with('success','Order created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchase_order)
    {
        return view('backend.pages.purchase_orders.edit', compact('purchase_order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchase_order)
    {
        $format = \App\Config::where('account_id', Auth::user()->account_id)->first()->date_format;

        $payments = json_decode($purchase_order->payments);

        if($request->has('amount'))
        {
            foreach($request->amount as $key => $amount)
            {
                if($amount > 0){
                    $payment = array();
                    $payment['amount'] = $amount;
                    if($format == 'd/m/Y'){
                        $date = str_replace('/', '-', $request->date[$key]);
                    }
                    else if($format == 'm-d-Y'){
                        $date = str_replace('-', '/', $request->date[$key]);
                    }
                    $payment['date'] = strtotime($date);
                    $payment['method'] = $request->method[$key];
                    
                    array_push($payments, $payment);
                }
            }
        }

        $purchase_order->update(array_merge(['status' => $request->status], ['payments' => json_encode($payments)]));
        return redirect()->route('purchase_orders.index')
            ->with('success','Purcahse Order updated successfully');
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
        PurchaseOrder::destroy($id);
        return redirect()->route('purchase_orders.list')
            ->with('success','Order deleted successfully');
    }

    public function download($id)
    {
        $purchase_order = PurchaseOrder::find($id);
        
        if(Config::where('account_id', Auth::user()->account_id)->first()->template_version == 1){
            $pdf = PDF::loadView('pdf.template-1.purchase_order', compact('purchase_order'));
        }
        else{
            $pdf = PDF::loadView('pdf.template-2.purchase_order', compact('purchase_order'));
        }
        return $pdf->download('purchase_order-'.$purchase_order->po.'.pdf');
        
        //return view('pdf.invoice', compact('invoice'));
    }

    public function preview($id)
    {
        $purchase_order = PurchaseOrder::find($id);
        
        if(Config::where('account_id', Auth::user()->account_id)->first()->template_version == 1){
            return view('pdf.template-1.purchase_order', compact('purchase_order'));
        }
        else{
            return view('pdf.template-2.purchase_order', compact('purchase_order'));
        }
    }
}
