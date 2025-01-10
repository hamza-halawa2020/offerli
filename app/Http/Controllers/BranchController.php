<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Branch;
use Illuminate\Http\Request;


class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Brand $brand)
    {
        $branches= $brand->branches();
        // dd($branches);
        return view('dashboard.brands.branches',compact('branches'));
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
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->back();

    }
}
