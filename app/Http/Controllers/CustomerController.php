<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers=Customer::all();
        return view('dashboard.customers', compact('customers'));
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
    public function show(Customer $customer)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('dashboard.show-customer', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'  => 'string',
            'name_ar'  => 'string',
            'email' => 'email'
        ]);
        $customer->update([
            'name' => $request->input('modalEditUserFirstName'),
            'name_ar' => $request->input('modalEditUserFirstNameAR'),
            'slug' => Str::slug($request['modalEditUserFirstName']),
            'email' => $request->input('modalEditUserEmail'),
            'phone' => $request->input('modalEditUserPhone'),
        ]);
        $customers=Customer::all();
        return redirect()->route('customers.index', compact('customers'));
    }

    public function see(Customer $customer)
    {
        return view('dashboard.customer-acc',compact('customer'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->back();
    }
    public function block(Request $request ,Customer $customer)
    {
        if($request['time']){
            $customer->update(['blocked' => 1 , 'blocked_until' =>now()->addDays($request['time'])]);
        }
        $customers=Customer::all();
        return redirect()->route('customers.index', compact('customers'));
    }
    public function unBlock(Customer $customer)
    {
        $customer->update(['blocked' => 0,'blocked_until'=>null]);
        return redirect()->back();
    }
}
