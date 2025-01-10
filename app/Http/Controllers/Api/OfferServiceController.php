<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OffersService;
use App\Models\Service;
use Illuminate\Http\Request;
use Exception;

class OfferServiceController extends Controller
{
    /**
     * Display a listing of the offers for the authenticated user's services.
     */
    public function index()
    {

    }

    /**
     * Store a newly created offer in storage.
     */
    public function store(Request $request, $serviceId)
    {
        $user = auth('brand')->user();

        if (!$user || !$user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'priceBeforeDiscount' => 'required|numeric',
            'discount' => 'nullable|numeric',
        ]);

        try {
            $service = Service::findOrFail($serviceId);

            if ($service->brand_id !== $user->id) {
                return response()->json(['error' => 'Unauthorized: You can only add offers to your own services.'], 403);
            }

            $priceAfterDiscount = $validatedData['priceBeforeDiscount'] - ($validatedData['discount'] ?? 0);

            $service->offersServices()->create([
                'name_ar' => $validatedData['name_ar'],
                'name_en' => $validatedData['name_en'],
                'priceBeforeDiscount' => $validatedData['priceBeforeDiscount'],
                'priceAfterDiscount' => $priceAfterDiscount,
                'discount' => $validatedData['discount'],
                'service_id' => $service->id,
            ]);

            return response()->json(['message' => 'Offer added successfully'], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while adding the offer', 'details' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified offer details.
     */



    public function show(string $id)
    {

    }



    /**
     * Update the specified offer in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = auth('brand')->user();

        if (!$user || !$user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'name_ar' => 'string|max:255',
            'name_en' => 'string|max:255',
            'priceBeforeDiscount' => 'numeric',
            'discount' => 'numeric',
        ]);

        try {
            $offer = OffersService::find($id);
            if (!$offer || $offer->service->brand_id !== $user->id) {
                return response()->json(['error' => 'Offer not found or not authorized to view'], 404);
            }


            $offer->update([
                'name_ar' => $validatedData['name_ar'] ?? $offer->name_ar,
                'name_en' => $validatedData['name_en'] ?? $offer->name_en,
                'priceBeforeDiscount' => $validatedData['priceBeforeDiscount'] ?? $offer->priceBeforeDiscount,
                'discount' => $validatedData['discount'] ?? $offer->discount,
                'priceAfterDiscount' => ($validatedData['priceBeforeDiscount'] ?? $offer->priceBeforeDiscount) - ($validatedData['discount'] ?? $offer->discount),
            ]);

            return response()->json(['message' => 'Offer updated successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the offer', 'details' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified offer from storage.
     */
    public function destroy(string $id)
    {
        $user = auth('brand')->user();

        if (!$user || !$user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            $offer = OffersService::find($id);
            if (!$offer || $offer->service->brand_id !== $user->id) {
                return response()->json(['error' => 'Offer not found or not authorized to view'], 404);
            }
            $offer->delete();

            return response()->json(['message' => 'Offer deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the offer', 'details' => $e->getMessage()], 500);
        }
    }
}
