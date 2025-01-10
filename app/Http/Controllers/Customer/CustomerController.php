<?php

namespace App\Http\Controllers\Customer;

use App\Models\Brand;
use App\Models\Status;
use App\Models\Payment;
use App\Models\Voucher;
use App\Models\Advertise;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CustomerVoucher;
use App\Models\CustomerWishlist;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\ImagesResource;
use App\Http\Resources\StatusResource;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\VoucherResource;
use App\Http\Resources\CustomerResource;
use Kutia\Larafirebase\Facades\Larafirebase;
use App\Http\Resources\CustomerVoucherResource;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth:customer');
    }
    public function profile()
    {
        $customer = auth('customer')->user();
        // dd($customer->customerwishlist);
        return new CustomerResource($customer);
    }
    public function payments()
    {
        $payments = Payment::latest()->get();
        return PaymentResource::collection($payments);
    }
    public function adverises()
    {
        $advertises = Advertise::latest()->get();
        return ImagesResource::collection($advertises);
    }
    public function status()
    {
        $status = Status::latest()->get();
        return StatusResource::collection($status);
    }
    public function brands()
    {
        $brands = Brand::where('active', 1)->get();
        return BrandResource::collection($brands);
    }
    public function vouchers()
    {
        $vouchers = Voucher::where('active', 1)->latest()->get();
        return VoucherResource::collection($vouchers);
    }
    public function usevoucher(Request $request)
    {
        $voucher = Voucher::where('id', $request->voucher_id)->first();
        $timesOfUse = CustomerVoucher::where('customer_id', auth('customer')->user()->id)
            ->where('voucher_id', $request->voucher_id)
            ->count();

        if ((!$voucher->singleUse) || $timesOfUse < 1) {

            $request->validate([
                'branch_id' => 'required',
                'voucher_id' => 'required',
                'payment_id' => 'required',
                'paid_price' => 'required',
                'rating' => 'numeric',
                'rating_comment' => 'string',
            ]);
            // if ($request->input('payment_id') == 1) {
            //     $status_id = 2;
            // } else {
            $status_id = 1;
            // }
            CustomerVoucher::create([
                'code' => Str::random(8),
                'branch_id' => $request->input('branch_id'),
                'customer_id' => auth('customer')->user()->id,
                'voucher_id' => $request->input('voucher_id'),
                'payment_id' => $request->input('payment_id'),
                'status_id' => $status_id,
                'expire_at' => now()->addDays(120),
                'paid_price' => $request->input('paid_price'),
                'rating' => $request->input('rating'),
                'rating_comment' => $request->input('rating_comment'),
            ]);

            // Assuming $voucher->brand->device_token is a comma-separated string
            $deviceTokens = explode(',', $voucher->brand->device_token);

            Larafirebase::fromArray(['title' => 'استخدام قسيمة', 'body' => 'تم استخدام قسيمة لديك'])
                ->sendNotification($deviceTokens);

            return response()->json(['message' => 'Customer Used Voucher Successfully'], 200);
        } else {
            return response()->json(['message' => 'Customer Can Not Use This Voucher'], 403);
        }
    }

    public function redeem(Request $request)
    {
        $request->validate([
            'customer_voucher_id' => 'required',
        ]);
        $customervoucher = CustomerVoucher::where('id', $request->customer_voucher_id)->first();
        if ($customervoucher && $customervoucher->status_id != 2) {
            return response()->json(['message' => 'Success!', 'code' => $customervoucher->code, 'branch_id' => $customervoucher->branch_id], 200);
        }
        return response()->json(['message' => ' This Voucher Can not be Redeemed '], 403);
    }

    public function history(Request $request)
    {
        $vouchers = CustomerVoucher::where('customer_id', auth('customer')->user())->get();
        return CustomerVoucherResource::collection($vouchers);
    }

    public function addwishlist(Request $request)
    {
        $request->validate([
            'voucher_id' => 'required',
        ]);
        CustomerWishlist::create(['customer_id' => auth('customer')->user()->id, 'voucher_id' => $request->voucher_id]);
        return response()->json(['message' => 'Customer Wishlisted Voucher Successfully'], 200);
    }

    public function removeWishlist(Request $request)
    {
        $request->validate([
            'voucher_id' => 'required',
        ]);
        $vouchers = CustomerWishlist::where('customer_id', auth('customer')->user()->id)->get();
        $vouchers->where('voucher_id', $request->voucher_id)->first()->delete();
        return response()->json(['message' => 'Voucher removed from Wishlist Successfully'], 200);
    }
}
