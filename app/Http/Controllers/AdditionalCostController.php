<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdditionalCost;

class AdditionalCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.configs.add_cost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AdditionalCost::create(array_merge($request->all()));

        return redirect()->route('configs.additional_cost')
            ->with('success','Additional Cost created successfully');
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
    public function edit($id)
    {
        $additional_cost = AdditionalCost::find($id);
        return view('backend.pages.configs.edit_cost', compact('additional_cost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $additional_cost = AdditionalCost::find($id);
        $additional_cost->update(array_merge($request->all()));
        return redirect()->route('configs.additional_cost')
            ->with('success','Additional Cost updated successfully');
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
        AdditionalCost::destroy($id);
        return redirect()->route('configs.additional_cost')
            ->with('success','Additional Cost deleted successfully');
    }
}
