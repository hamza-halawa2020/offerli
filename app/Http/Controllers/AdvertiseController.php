<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Advertise;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advertises = Advertise::all();
        return view('dashboard.advertise.advertise', compact(['advertises']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $services = Service::all();
        return view('dashboard.advertise.add-advertise', compact(['brands', 'services']));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $image = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $folderPath = 'images/advertise/';
        $image->move(public_path($folderPath), $filename);
        Advertise::create([
            'brand_id' => $request->brand_id,
            'service_id' => $request->service_id,
            'image' => $filename,
        ]);
        return redirect()->route('advertise.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Advertise $advertise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advertise $advertise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advertise $advertise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertise $advertise)
    {
        Storage::delete('public/' . $advertise->image);
        $advertise->delete();
        return redirect()->route('advertise.index');
    }
}
