<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerVoucher;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ratedVouchers = CustomerVoucher::whereNotNull('rating')->get();
        return view('dashboard.rating', compact('ratedVouchers'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customervoucher = CustomerVoucher::where('id', $id)->first();
        $customervoucher->update(['rating' => null, 'rating_comment' => null]);
        $ratedVouchers = CustomerVoucher::whereNotNull('rating')->get();
        return redirect()->route('rating.index',compact('ratedVouchers'));
    }
}
