<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Customer;
use Exception;
class ReviewServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function addReview(Request $request, $serviceId)
    {
        // Authenticate customer
        $user = auth('customer')->user();

        if (!$user || !$user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Validate input data
        $validatedData = $request->validate([
            'review' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        try {
            $service = Service::findOrFail($serviceId);

            $existingCustomer = Customer::find($user->id);
            if (!$existingCustomer) {
                return response()->json(['error' => 'Customer not found in the database'], 404);
            }

            if (!$user->id) {
                return response()->json(['error' => 'Customer ID is not set'], 500);
            }

            $service->reviews()->create([
                'review' => $validatedData['review'],
                'comment' => $validatedData['comment'],
                'service_id' => $service->id,
                'customer_id' => $user->id,
            ]);

            return response()->json(['message' => 'Review added successfully'], 201);
            // return response()->json(new ServiceReviewResource($service), 201);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'An error occurred while adding the review',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    public function index()
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
