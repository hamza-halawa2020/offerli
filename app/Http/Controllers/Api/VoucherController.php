<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;


class VoucherController extends Controller
{
    /**
     * Display a listing of the vouchers.
     */
    public function index()
    {
        $vouchers = Voucher::all();
        return response()->json($vouchers, 200);
    }

    /**
     * Store a newly created voucher in storage.
     */
    public function store(Request $request)
    {

        $user = auth('brand')->user();

        if (!$user || !$user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }



        $validatedData = $request->validate([
            'dealAmount' => 'required|numeric|between:1,100',
            'price' => 'required|numeric',
            'subcategory' => 'required|exists:subcategories,id',
            'dealTitle' => 'required|string|max:255',
            'dealDuration' => 'required|date|after:' . now()->addDays(3),
            'dealMaxUsers' => 'required|numeric|min:1',
            'dealPaymentMethod' => 'nullable|numeric',
            'dealLimitUser' => 'nullable|numeric|min:1',
            'dealDescription' => 'nullable|string',
        ]);

        try {
            $voucher = Voucher::create([
                'code' => Str::upper(Str::random(8)),
                'title' => $validatedData['dealTitle'],
                'slug' => Str::slug($validatedData['dealTitle']),
                'price' => $validatedData['price'],
                'discount' => $validatedData['dealAmount'],
                'expire_at' => $validatedData['dealDuration'],
                'limit' => $validatedData['dealMaxUsers'],
                'brand_id' => $user->id,
                'payment_id' => $validatedData['dealPaymentMethod'],
                'singleUse' => $validatedData['dealLimitUser'],
                'subcategory_id' => $validatedData['subcategory'],
                'description' => $validatedData['dealDescription'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Voucher created successfully',
                'voucher' => $voucher
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create voucher',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified voucher.
     */
    public function show(string $id)
    {
        $voucher = Voucher::find($id);

        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Voucher not found'
            ], 404);
        }

        return response()->json($voucher, 200);
    }

    /**
     * Update the specified voucher in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = auth('brand')->user();

        if (!$user || !$user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $voucher = Voucher::find($id);

        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Voucher not found'
            ], 404);
        }

        if ($voucher->brand_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to update this voucher'
            ], 403);
        }

        try {
            $validatedData = $request->validate([
                'dealAmount' => 'sometimes|numeric|between:1,100',
                'price' => 'sometimes|numeric',
                'dealTitle' => 'sometimes|string|max:255',
                'dealDuration' => 'sometimes|date|after:' . now(),
                'dealMaxUsers' => 'sometimes|numeric|min:1',
                'dealPaymentMethod' => 'nullable|numeric',
                'dealLimitUser' => 'nullable|numeric|min:1',
                'dealDescription' => 'nullable|string',
            ]);

            $voucher->update(array_filter([
                'discount' => $validatedData['dealAmount'] ?? $voucher->discount,
                'price' => $validatedData['price'] ?? $voucher->price,
                'title' => $validatedData['dealTitle'] ?? $voucher->title,
                'expire_at' => $validatedData['dealDuration'] ?? $voucher->expire_at,
                'limit' => $validatedData['dealMaxUsers'] ?? $voucher->limit,
                'payment_id' => $validatedData['dealPaymentMethod'] ?? $voucher->payment_id,
                'singleUse' => $validatedData['dealLimitUser'] ?? $voucher->singleUse,
                'description' => $validatedData['dealDescription'] ?? $voucher->description,
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Voucher updated successfully',
                'voucher' => $voucher
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update voucher',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified voucher from storage.
     */
    public function destroy(string $id)
    {

        $user = auth('brand')->user();

        if (!$user || !$user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $voucher = Voucher::find($id);

        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Voucher not found'
            ], 404);
        }

        if ($voucher->brand_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to update this voucher'
            ], 403);
        }


        $voucher->delete();

        return response()->json([
            'success' => true,
            'message' => 'Voucher deleted successfully'
        ], 200);
    }
}
