<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandImages;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Brand $brand)
    {
        $images = $brand->images;
        return view('dashboard.brands.images', compact(['images', 'brand']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Brand $brand)
    {
        return view('dashboard.brands.addImage', compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Brand $brand)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // $image = $request->file('logo');
        // $imageName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . time() . '.' . $image->getClientOriginalExtension();
        // $imagePath = $image->storeAs('images\brandImage', $imageName, 'public');

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $folderPath = 'images/brand/';
            $image->move(public_path($folderPath), $filename);
            $validatedData['logo'] = $filename;
        }

        BrandImages::create([
            'brand_id' => $brand->id,
            'image' => $filename,

        ]);

        return redirect()->route('images.index', compact('brand'));
    }

    /**
     * Display the specified resource.
     */
    public function show(BrandImages $brandImages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BrandImages $brandImages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BrandImages $brandImages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand, BrandImages $image)
    {
        // dd($brandImages);
        $image->delete();
        Storage::delete('public/' . $image->image);
        return redirect()->route('images.index', compact('brand'));
    }
}
