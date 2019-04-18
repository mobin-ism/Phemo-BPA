<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\UnitOfMeasure;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Exports\ServicesExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
	{
		$services = Service::where('account_id', Auth::user()->account_id)->get();
        return view('backend.pages.services.index',compact('services'));
	}

	public function create()
	{
		return view('backend.pages.services.create');
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'code' => 'required|unique:services,code',
            'name' => 'required',
            'rate' => 'required|numeric'
        ]);

        if ($validator->passes()) {
            Service::create($request->all());
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }

        return response()->json(['errors'=>$validator->errors()]);
	}

	public function show(Service $service)
	{
		return view('backend.pages.services.show', compact('service'));
	}

	public function edit(Service $service)
	{
		return view('backend.pages.services.edit',compact('service'));
	}

	public function update(Request $request, Service $service)
	{
		$validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
            'rate' => 'required|numeric'
        ]);

        if ($validator->passes()) {
            $service->update($request->all());
            $request->session()->flash('success', 'success_msg');
            return response()->json(['success' => '1']);
        }
        return response()->json(['errors'=>$validator->errors()]);
	}
	
	public function destroy($id)
	{
		
	}

    public function delete($id)
    {
        Service::destroy($id);
        return redirect()->route('services.index')
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
        $services = Service::where('account_id', Auth::user()->account_id)->get();
        $pdf = PDF::loadView('backend.pages.services.exports.services', compact('services'));
        return $pdf->download('services-' . get_config('company_name') . '-' . time() . '.pdf');
    }

    public function excel()
    {
        $account_id = Auth::user()->account_id;
        return (new ServicesExport($account_id))->download('services-' . get_config('company_name') . '-' . time() . '.xlsx');
    }
}
