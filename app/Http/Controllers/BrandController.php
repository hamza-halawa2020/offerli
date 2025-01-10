<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Support\Str;
use App\Events\BrandCreated;
use Illuminate\Support\Facades\Storage;

use App\Models\WorkingHours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('dashboard.brands.brands', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Brand $brand)
    {
        return view('dashboard.brands.create-brand');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'name_ar' => 'required|string',
            'email' => 'required|email|unique:brands,email',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|min:6|confirmed',
            'description' => 'required',
            'percentage' => 'required',
            'vat_no' => 'required',
            'Com_Reg_No' => 'required',
            'phone' => 'required',
        ]);

        $validatedData = $request->only([
            'name',
            'name_ar',
            'email',
            'password',
            'description',
            'percentage',
            'vat_no',
            'Com_Reg_No',
            'phone',
            'address',
            'other_fee'
        ]);

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            // $folderPath = 'images/brand/';
            $folderPath = 'images/brand/' . $request->id . '/';
            $image->move(public_path($folderPath), $filename);
            $validatedData['logo'] = $filename;
        }

        $validatedData['slug'] = Str::slug($request->name);
        $validatedData['password'] = Hash::make($request->password);

        $brand = Brand::create($validatedData);

        // Event::dispatch(new BrandCreated($brand));

        return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view('dashboard.brands.branches', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('dashboard.brands.edit-brand', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'string',
            'name_ar' => 'string',
            'email' => 'email',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'min:6|confirmed',
        ]);

        $input = $request->except('logo', 'password_confirmation');

        if ($request->hasFile('logo')) {
            // Delete the old logo if it exists
            if ($brand->logo) {
                Storage::delete('public/' . $brand->logo);
            }

            $image = $request->file('logo');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $folderPath = 'images/brand/';
            $image->move(public_path($folderPath), $filename);
            $input['logo'] = $filename;
        }

        if ($request->filled('password')) {
            $input['password'] = Hash::make($request->password);
        }

        $brand->update($input);

        return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
    }

    public function workingHours(Request $request, Brand $brand)
    {
        // $request->validate([
        //     'sun_ot' => 'date_format:H:i',
        //     'sun_ct' => 'date_format:H:i',
        //     'mon_ot' => 'date_format:H:i',
        //     'mon_ct' => 'date_format:H:i',
        //     'tue_ot' => 'date_format:H:i',
        //     'tue_ct' => 'date_format:H:i',
        //     'wed_ot' => 'date_format:H:i',
        //     'wed_ct' => 'date_format:H:i',
        //     'thu_ot' => 'date_format:H:i',
        //     'thu_ct' => 'date_format:H:i',
        //     'fri_ot' => 'date_format:H:i',
        //     'fri_ct' => 'date_format:H:i',
        // ]);
        WorkingHours::updateOrCreate(
            [
                'brand_id' => $brand->id
            ],
            [
                'sun_ot' => $request->sun_ot,
                'sun_ct' => $request->sun_ct,
                'mon_ot' => $request->mon_ot,
                'mon_ct' => $request->mon_ct,
                'tue_ot' => $request->tue_ot,
                'tue_ct' => $request->tue_ct,
                'wed_ot' => $request->wed_ot,
                'wed_ct' => $request->wed_ct,
                'thu_ot' => $request->thu_ot,
                'thu_ct' => $request->thu_ct,
                'fri_ot' => $request->fri_ot,
                'fri_ct' => $request->fri_ct,
                'sat_ot' => $request->sat_ot,
                'sat_ct' => $request->sat_ct
            ]
        );
        $brands = Brand::all();
        return redirect()->route('brands.index', compact('brands'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        // dd($brand);

        $brand->delete();
        return redirect()->back();
    }
    public function Activate(Brand $brand)
    {
        $brand->update(['active' => 1]);
        return redirect()->back();
    }
    public function Deactivate(Brand $brand)
    {
        $brand->update(['active' => 0]);
        return redirect()->back();
    }
    public function see(Brand $brand)
    {
        return view('dashboard.brands.brand-acc', compact('brand'));
    }

    public function featured(Request $request, Brand $brand)
    {
        if ($request['time']) {
            // $brand->featured_until = now()->addDays($request['time']);
            $brand->update(['featured' => 1, 'featured_until' => now()->addDays($request['time'])]);
        }
        $brands = Brand::all();
        return redirect()->route('brands.index', compact('brands'));
    }
    public function unfeatured(Brand $brand)
    {
        $brand->update(['featured' => 0, 'featured_until' => null]);
        return redirect()->back();
    }
}
