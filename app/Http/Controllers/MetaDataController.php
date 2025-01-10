<?php

namespace App\Http\Controllers;

use App\Models\MetaData;
use Illuminate\Http\Request;

class MetaDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MetaData $metaData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MetaData $metaData)
    {
        $settings = MetaData::first();
        return view('dashboard.settings', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request);
        $settings=MetaData::first();
        $request->validate([
            'name'  => 'required',
            'name_ar'  => 'required',
            'address'  => 'required',
            'email'  => 'required|email',
            'bank_commission'  => 'required|numeric|between:1,100',
            'vat_no'  => 'required',
            'Com_Reg_No'  => 'required',
        ]);
        $settings->update([
            'name' => $request['name'],
            'name_ar' => $request['name_ar'],
            'address' => $request['address'],
            'email' => $request['email'],
            'bank_commission' => $request['bank_commission'],
            'vat_no' => $request['vat_no'],
            'Com_Reg_No' => $request['Com_Reg_No']
        ]);

        return redirect()->route('settings.edit', compact('settings'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MetaData $metaData)
    {
        //
    }
}
