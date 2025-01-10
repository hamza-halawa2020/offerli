<?php

namespace App\Http\Controllers;

use App\Models\Landing;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $landings = Landing::all();
        return view('dashboard.landing.index', compact(['landings']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.landing.add-image');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $image = $request->file('logo');
        $imageName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('images\landing', $imageName, 'public');
        Landing::create([
            'image' => $imagePath,
        ]);
        return redirect()->route('landing.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Landing $landing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Landing $landing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Landing $landing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Landing $landing)
    {
        $landing->delete();
        Storage::delete('public/' . $landing->image);
        return redirect()->route('landing.index');
    }
}
