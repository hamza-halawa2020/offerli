<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CustomerFavourite;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerFavouriteController extends Controller
{
    /**
     * Display a listing of the customer's favorite services.
     */
    public function index()
    {
        $user = auth('customer')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $favorites = CustomerFavourite::where('customer_id', $user->id)->with('service')->get();

        return response()->json($favorites, 200);
    }

    /**
     * Store a newly created favorite service.
     */
    public function store(Request $request)
    {
        $user = Auth::guard('customer')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'service_id' => 'required|exists:services,id',
        ]);

        // Check if the favorite already exists
        $exists = CustomerFavourite::where('customer_id', $user->id)
            ->where('service_id', $validatedData['service_id'])
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Service is already in your favorites'], 409);
        }

        // Add the service to the customer's favorites
        $favorite = CustomerFavourite::create([
            'customer_id' => $user->id,
            'service_id' => $validatedData['service_id'],
        ]);

        return response()->json(['message' => 'Service added to favorites', 'data' => $favorite], 201);
    }

    /**
     * Display the specified favorite service.
     */
    public function show($id)
    {
        $user = Auth::guard('customer')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $favorite = CustomerFavourite::where('id', $id)
            ->where('customer_id', $user->id)
            ->with('service')
            ->first();

        if (!$favorite) {
            return response()->json(['error' => 'Favorite not found'], 404);
        }

        return response()->json($favorite, 200);
    }

    /**
     * Remove the specified service from favorites.
     */
    public function destroy($id)
    {
        $user = Auth::guard('customer')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $favorite = CustomerFavourite::where('id', $id)
            ->where('customer_id', $user->id)
            ->first();


        if (!$favorite) {
            return response()->json(['message' => 'There is No Favorite in this id ' . $id], 404);
        }

        $favorite->delete();

        return response()->json(['message' => 'Favorite removed successfully'], 200);
    }
}
