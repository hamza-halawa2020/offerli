<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brand;
use App\Models\Branch;
use App\Models\Voucher;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Subcategory;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\CustomerVoucher;

class DashboardController extends Controller
{

    public function welcome()
    {

        return view('welcome');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        $branches = Branch::all();
        $vouchers = Voucher::all();
        $soldVoucher = CustomerVoucher::all();
        $totalProfit = 0;
        // foreach ($soldVoucher as $voucher){
        //     $totalProfit = $totalProfit  +(($voucher->branch->brand->percentage ) * $voucher->paid_price /100);
        // }

        $weekVoucher = CustomerVoucher::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->get();
        $weekCustomer = Customer::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->get();
        $weekVouchers = Voucher::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->get();
        $weekBrands = Brand::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->get();

        $claimedVouchers = CustomerVoucher::where('status_id', 3)->get();
        $invoicedVouchers = CustomerVoucher::whereNotNull('invoice_id')->get();
        $users = User::where('active', 1)->get();

        $notifications = Notification::latest()->get();

        return view('dashboard.index', [
            'customers' => $customers,
            'brands' => $brands,
            'vouchers' => $vouchers
            ,
            'users' => $users,
            'branches' => $branches,
            'soldVoucher' => $soldVoucher,
            'categories' => $categories
            ,
            'subcategories' => $subcategories,
            'weekVoucher' => $weekVoucher,
            'weekCustomer' => $weekCustomer
            ,
            'weekVouchers' => $weekVouchers,
            'weekBrands' => $weekBrands,
            'claimedVouchers' => $claimedVouchers
            ,
            'invoicedVouchers' => $invoicedVouchers,
            'notifications' => $notifications,
            'profit' => $totalProfit
        ]);
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
        //
    }
}
