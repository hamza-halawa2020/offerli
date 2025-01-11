<?php

namespace App\Http\Controllers\Brand;

use App\Models\Brand;
use App\Models\Branch;
use App\Models\Voucher;
use App\Models\BrandImages;
use Illuminate\Support\Str;
use App\Models\WorkingHours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Events\BrandFeatured;
use App\Models\VoucherBranch;
use App\Events\VoucherCreated;
use App\Models\CustomerVoucher;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use Illuminate\Support\Facades\Event;
use App\Http\Resources\BranchResource;
use App\Http\Resources\VoucherResource;
use App\Http\Resources\CustomerVoucherResource;
use App\Http\Resources\BranchesResource;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:brand');
    }
    public function profile()
    {
        $barnd = auth('brand')->user();
        return new BrandResource($barnd);
    }
    public function branches(Request $request)
    {
        $branches = Branch::where('brand_id', auth('brand')->user()->id)->get();
        return BranchesResource::collection($branches);
    }
    public function newbranch(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'name_ar' => 'required|string',
            'phone' =>  'required',
            'address' =>  'required',
            'latitude' =>  'required',
            'longitude' =>  'required',
        ]);
        $branch = Branch::create([
            'name' => $request->input('name'),
            'name_ar' => $request->input('name_ar'),
            'slug' => Str::slug($request['name']),
            'phone' => $request->input('phone'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'address' => $request->input('address'),
            'brand_id' => auth('brand')->user()->id,
        ]);
        return response()->json(['message' => 'Branch Created Successfully', 'branch' => new BranchResource($branch)], 200);
    }
    public function showbranch(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
        ]);
        $branch = Branch::where('id', $request->branch_id)->first();
        return  new BranchResource($branch);
    }
    public function editbranch(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'name' => 'string',
            'name_ar' => 'string',
        ]);
        $branch = Branch::where('id', $request->branch_id)->first();
        $branch->update($request->all());

        return response()->json(['message' => 'Branch Updated Successfully', 'branch' => new BranchResource($branch)], 200);
    }
    public function deletebranch(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
        ]);
        $branch = Branch::where('id', $request->branch_id)->first();
        $branch->delete();
        return response()->json(['message' => 'Branch Deleted Successfully'], 200);
    }
    public function newVoucher(Request $request)
    {
        $request->validate([
            'price' => 'required|numeric',
            'discount' =>  'required|numeric|between:1,100',
            'expire_at' => 'required|date|after:' . now()->addDays(3),
            'limit' =>  'required|numeric',
            'singleUse' =>  'required|numeric',
            'subcategory_id' =>  'required',
            'payment_id' =>  'numeric',
        ]);
        $voucher = Voucher::create([
            'code' => Str::random(8),
            'slug' => Str::slug($request['code']),
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'expire_at' => $request->input('expire_at'),
            'limit' => $request->input('limit'),
            'payment_id' => $request->input('payment_id'),
            'singleUse' => $request->input('singleUse'),
            'brand_id' => auth('brand')->user()->id,
            'subcategory_id' => $request->input('subcategory_id'),
        ]);
        Event::dispatch(new VoucherCreated($voucher));

        return response()->json(['message' => 'Voucher Created Successfully', 'Voucher' => new VoucherResource($voucher)], 200);
    }
    public function deleteVoucher(Request $request)
    {
        $request->validate([
            'voucher_id' => 'required',
        ]);
        $voucher = Voucher::where('id', $request->voucher_id)->first();
        $voucher->delete();
        return response()->json(['message' => 'Voucher Deleted Successfully'], 200);
    }
    public function newEvent(Request $request)
    {
        $request->validate([
            'price' => 'required|numeric',
            'discount' =>  'required|numeric|between:1,100',
            'start_at' => 'required|date',
            'expire_at' => 'required|date',
            'limit' =>  'required|numeric',
            'singleUse' =>  'required|numeric',
            'subcategory_id' =>  'required',
            'payment_id' =>  'numeric',
        ]);
        $voucher = Voucher::create([
            'code' => Str::random(8),
            'slug' => Str::slug($request['code']),
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'start_at' => $request->input('expire_at'),
            'expire_at' => $request->input('expire_at'),
            'limit' => $request->input('limit'),
            'singleUse' => $request->input('singleUse'),
            'payment_id' => $request->input('payment_id'),
            'brand_id' => auth('brand')->user()->id,
            'subcategory_id' => $request->input('subcategory_id'),
        ]);
        Event::dispatch(new VoucherCreated($voucher));

        return response()->json(['message' => 'Event Created Successfully', 'Voucher' => new VoucherResource($voucher)], 200);
    }
    public function deleteEvent(Request $request)
    {
        $request->validate([
            'voucher_id' => 'required',
        ]);
        $voucher = Voucher::where('id', $request->voucher_id)->first();
        $voucher->delete();
        return response()->json(['message' => 'Event Deleted Successfully'], 200);
    }
    public function brandVouchers(Request $request)
    {

        $vouchers = Voucher::where('brand_id',auth('brand')->user()->id)->get();
        return VoucherResource::collection($vouchers);
    }

    public function addVoucherBranch(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'voucher_id' => 'required',
        ]);
        $voucherBranch = VoucherBranch::where('branch_id', $request->branch_id)->get();
        $voucherBranch = $voucherBranch->where('voucher_id', $request->voucher_id)->count();
        if($voucherBranch<1){

            VoucherBranch::create([
                'branch_id' => $request->input('branch_id'),
                'voucher_id' => $request->input('voucher_id'),
            ]);
            return response()->json(['message' => 'Voucher Added To The Branch Successfully'], 200);
        }
        else
        {
            return response()->json(['message' => 'Voucher is already Applied to the branch'], 403);
        }
    }
    public function branchVouchers(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
        ]);
        $branch = Branch::where('id', $request->branch_id)->first();
        $vouchers = $branch->vouchers;
        return VoucherResource::collection($vouchers);
    }

    //test again
    public function deleteBranchVouchers(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'voucher_id' => 'required',
        ]);

        $voucherBranch = VoucherBranch::where('branch_id', $request->branch_id)->get();
        $voucherBranch = $voucherBranch->where('voucher_id', $request->voucher_id);
        foreach ($voucherBranch as $voucher) {
            $voucher->delete();
        }

        return response()->json(['message' => 'Voucher Removed from The Branch Successfully'], 200);
    }

    public function befeatured(Request $request)
    {
        Event::dispatch(new BrandFeatured(auth('brand')->user()));
        return response()->json(['message' => 'Adminstator will contact you Very Soon!'], 200);
    }
    public function beredeemed(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'branch_id' => 'required',
        ]);
        $customervoucher = CustomerVoucher::where('code', $request->code)->first();
        if ($customervoucher && $customervoucher->status_id != 2 && $customervoucher->branch_id == $request->branch_id) {
            $customervoucher->update(['status_id' => 2]);
            return response()->json(['message' => 'Voucher Redeemed', 'voucher' => new CustomerVoucherResource($customervoucher)], 200);
        }
        return response()->json(['message' => ' This Voucher Can not be Redeemed '], 403);
    }
    public function workingHours(Request $request)
    {
        $request->validate([
            'sun_ot' => 'date_format:H:i',
            'sun_ct' => 'date_format:H:i',
            'mon_ot' => 'date_format:H:i',
            'mon_ct' => 'date_format:H:i',
            'tue_ot' => 'date_format:H:i',
            'tue_ct' => 'date_format:H:i',
            'wed_ot' => 'date_format:H:i',
            'wed_ct' => 'date_format:H:i',
            'thu_ot' => 'date_format:H:i',
            'thu_ct' => 'date_format:H:i',
            'fri_ot' => 'date_format:H:i',
            'fri_ct' => 'date_format:H:i',
            'sat_ot' => 'date_format:H:i',
            'sat_ct' => 'date_format:H:i',
        ]);
        WorkingHours::updateOrCreate(
            [
                'brand_id' => auth('brand')->user()->id
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
        return response()->json(['message' => ' Working Hours Updated Successfully'], 200);
    }

    public function addImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $image = $request->file('image');
        $imageName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('images\brandImage', $imageName, 'public');
        BrandImages::create([
            'image' => $imagePath,
            'brand_id' => auth('brand')->user()->id,
        ]);
        return response()->json(['message' => 'Image Added Successfully'], 200);
    }
    public function deleteImage(Request $request)
    {
        $request->validate([
            'image_id' => 'required',
        ]);
        $image = BrandImages::where('id', $request->image_id)->first();
        Storage::delete('public/' . $image->image);
        $image->delete();
        return response()->json(['message' => 'Image Deleted Successfully'], 200);
    }
}
