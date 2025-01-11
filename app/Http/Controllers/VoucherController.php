<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Payment;
use App\Models\Voucher;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\VoucherCreated;
use Illuminate\Support\Facades\Event;
use Carbon\Carbon;


class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = Voucher::all();
        return view('dashboard.vouchers.vouchers', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $subCategories = Subcategory::all();
        $paymenttypes = Payment::all();
        return view('dashboard.vouchers.new-voucher', compact(['brands', 'subCategories', 'paymenttypes'])); //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'dealAmount' => 'required|numeric|between:1,100',
            'price' => 'required',
            'brand' => 'required',
            'subcategory' =>  'required',
            'dealTitle' => 'required|string',
            // 'dealCode' => 'required',
            'dealDuration' => 'required|date|after:' . now()->addDays(3),
            'dealMaxUsers' => 'required|numeric',
            'dealPaymentMethod' =>  'numeric',
            'dealLimitUser' =>  'nullable',
        ]);
        $voucher = Voucher::create([
            'code' => Str::random(8),
            'title' => $request->input('dealTitle'),
            'slug' => Str::slug($request['dealTitle']),
            'price' => $request->input('price'),
            'discount' => $request->input('dealAmount'),
            'expire_at' => $request->input('dealDuration'),
            'limit' => $request->input('dealMaxUsers'),
            'brand_id' => $request->input('brand'),
            'payment_id' => $request->input('dealPaymentMethod'),
            'singleUse' => $request->input('dealLimitUser'),
            'subcategory_id' => $request->input('subcategory'),
            'description' => $request->input('dealDescription'),
        ]);
        Event::dispatch(new VoucherCreated($voucher));
        $vouchers = Voucher::all();
        return view('dashboard.vouchers.vouchers', compact('vouchers'));
    }
    /**
     * Display the specified resource.
     */
     
      public function createEvent()
    {
        $brands = Brand::all();
        $category = Category::where('name', '=', 'event')->first();
        $subCategories = Subcategory::where('category_id', '=', $category->id)->get();
        // dd($subCategories);
        $paymenttypes = Payment::all();
        return view('dashboard.vouchers.new-event', compact(['brands', 'subCategories', 'paymenttypes'])); //
    }

    public function storeEvent(Request $request)
    {
        $category = Category::where('name', '=', 'event')->first();
        $subCategory = Subcategory::where('category_id', '=', $category->id)->first();
        // dd($request);
        $request->validate([
            'dealAmount' => 'required|numeric|between:0,100',
            'price' => 'numeric',
            'brand' => 'required',
            // 'subcategory' =>  'required',
            'dealTitle' => 'required|string',
            'dealDuration' => 'required',
            'dealMaxUsers' => 'required|numeric',
            'dealPaymentMethod' =>  'numeric',
            'dealLimitUser' =>  'nullable',
        ]);
        $dates = explode(" to ", $request->input('dealDuration'));
        $start_date = Carbon::parse($dates[0]);
        $end_date = Carbon::parse($dates[1]);
        $voucher = Voucher::create([
            'code' => Str::random(8),
            'title' => $request->input('dealTitle'),
            'slug' => Str::slug($request['dealTitle']),
            'price' => $request->input('price'),
            'discount' => $request->input('dealAmount'),
            'start_at' => $start_date,
            'expire_at' => $end_date,
            'limit' => $request->input('dealMaxUsers'),
            'brand_id' => $request->input('brand'),
            'payment_id' => $request->input('dealPaymentMethod'),
            'singleUse' => $request->input('dealLimitUser'),
            'subcategory_id' => $subCategory->id,
            'description' => $request->input('dealDescription'),
        ]);
        Event::dispatch(new VoucherCreated($voucher));
        $vouchers = Voucher::all();
        return view('dashboard.vouchers.vouchers', compact('vouchers'));
    }
    public function show(Voucher $voucher)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voucher $voucher)
    {
        $brands = Brand::all();
        $subCategories = Subcategory::all();
        $paymenttypes = Payment::all();
        return view('dashboard.vouchers.edit-voucher', compact(['brands', 'subCategories', 'paymenttypes', 'voucher'])); //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voucher $voucher)
    {
        $request->validate([
            'dealAmount' => 'required|numeric|between:1,100',
            'price' => 'required',
            'brand' => 'required',
            'subcategory' =>  'required',
            'dealTitle' => 'string',
            // 'dealCode' => 'required',
            'dealDuration' => 'date|after:' . now()->addDays(3),
            'dealMaxUsers' => 'numeric',
            'dealPaymentMethod' =>  'numeric',
            'dealLimitUser' =>  'nullable',
        ]);
        $voucher->update([
            'code' => Str::random(8),
            'title' => $request->input('dealTitle'),
            'slug' => Str::slug($request['dealTitle']),
            'price' => $request->input('price'),
            'discount' => $request->input('dealAmount'),
            'expire_at' => $request->input('dealDuration'),
            'limit' => $request->input('dealMaxUsers'),
            'brand_id' => $request->input('brand'),
            'payment_id' => $request->input('dealPaymentMethod'),
            'singleUse' => $request->input('dealLimitUser'),
            'subcategory_id' => $request->input('subcategory'),
            'description' => $request->input('dealDescription'),
        ]);
        $vouchers = Voucher::all();
        return view('dashboard.vouchers.vouchers', compact('vouchers'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->back();
    }
    public function Activate(Voucher $voucher)
    {
        $voucher->update(['active' => 1]);
        return redirect()->back();
    }
    public function Deactivate(Voucher $voucher)
    {
        $voucher->update(['active' => 0]);
        return redirect()->back();
    }
}
