<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PettyCash;
use Illuminate\Support\Facades\Auth;

class PettyCashController extends Controller
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
        return view('backend.pages.petty_cashes.index');
    }


    public function list(){
        $petty_cashes = PettyCash::where('account_id', Auth::user()->account_id)->get();
        return view('backend.pages.petty_cashes.list',compact('petty_cashes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.petty_cashes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $format = \App\Config::where('account_id', Auth::user()->account_id)->first()->date_format;

        if($format == 'd/m/Y'){
            $request->date = str_replace('/', '-', $request->date);
        }
        elseif($format == 'm-d-Y'){
            $request->date = str_replace('-', '/', $request->date);
        }

        $date = strtotime($request->date);

        PettyCash::create(array_merge($request->all(), ['date' => $date]));

        return redirect()->route('petty_cashes.index')
            ->with('success','Petty Cash Request created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PettyCash $pettyCash)
    {
        return view('backend.pages.petty_cashes.show', compact('pettyCash'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PettyCash $pettyCash)
    {
        return view('backend.pages.petty_cashes.edit', compact('pettyCash'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PettyCash $pettyCash)
    {
        $format = \App\Config::where('account_id', Auth::user()->account_id)->first()->date_format;

        if($format == 'd/m/Y'){
            $request->date = str_replace('/', '-', $request->date);
        }
        elseif($format == 'm-d-Y'){
            $request->date = str_replace('-', '/', $request->date);
        }

        $date = strtotime($request->date);

        $pettyCash->update(array_merge($request->all(), ['date' => $date]));

        return redirect()->route('petty_cashes.index')
            ->with('success','Petty Cash Request updated successfully');
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
        PettyCash::destroy($id);
        return redirect()->route('petty_cashes.list')
            ->with('success','PettyCash deleted successfully');
    }

    public function reject($id)
    {
        $pettyCash = PettyCash::find($id);
        $pettyCash->changed_by = Auth::user()->name;
        $pettyCash->status = 3;
        $pettyCash->save();

        return redirect()->route('petty_cashes.list')
            ->with('success','PettyCash rejected successfully');
    }

    public function approve($id)
    {
        $pettyCash = PettyCash::find($id);
        $pettyCash->changed_by = Auth::user()->name;
        $pettyCash->status = 2;
        $pettyCash->save();

        return redirect()->route('petty_cashes.list')
            ->with('success','PettyCash approved successfully');
    }
}
