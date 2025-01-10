<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllServiceResource;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $services = Service::paginate(10);
            return AllServiceResource::collection($services);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $user = auth('brand')->user();

        if (!$user || !$user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description' => 'required|string',
            'mainImage' => 'required|file|mimes:jpg,jpeg,png|max:5000',
            'highlight' => 'required|string',
            'priceBeforeDiscount' => 'required|string',
            'discount' => 'nullable|string',
            'mainAddress' => 'required|string',
            'reserve' => 'required|string',
            'sub_category_id' => 'required|exists:subcategories,id',
            'locations' => 'nullable|array',
            'locations.*.name' => 'required|string',
            'locations.*.longitude' => 'required|string',
            'locations.*.latitude' => 'required|string',
            'about_deals' => 'nullable|array',
            'about_deals.*.answer' => 'required|string',
            'about_deals.*.question' => 'required|string',
            'images' => 'nullable|array',
            'images.*' => 'required|file|mimes:jpg,jpeg,png|max:5000',
        ]);

        try {

            // Handle main image upload
            $mainImage = $request->file('mainImage');
            $mainImageName = time() . '_' . uniqid() . $mainImage->getClientOriginalName();
            $mainImagePath = 'images/services/' . $mainImageName;
            $mainImage->move(public_path('images/services'), $mainImageName);

            $service = Service::create([
                'name_ar' => $validatedData['name_ar'],
                'name_en' => $validatedData['name_en'],
                'priceBeforeDiscount' => $validatedData['priceBeforeDiscount'],
                'discount' => $validatedData['discount'],
                'priceAfterDiscount' => $validatedData['priceBeforeDiscount'] - $validatedData['discount'],
                'mainAddress' => $validatedData['mainAddress'],
                'reserve' => $validatedData['reserve'],
                'description' => $validatedData['description'],
                'highlight' => $validatedData['highlight'],
                'sub_category_id' => $validatedData['sub_category_id'],
                'brand_id' => $user->id,
                'mainImage' => $mainImageName,
            ]);



            // Handle locations data
            if (isset($validatedData['locations'])) {
                foreach ($validatedData['locations'] as $locationData) {
                    $service->locations()->create($locationData);
                }
            }

            // Handle about deals data
            if (isset($validatedData['about_deals'])) {
                foreach ($validatedData['about_deals'] as $dealData) {
                    $service->aboutDeals()->create($dealData);
                }
            }
            // Handle additional images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . uniqid() . $image->getClientOriginalName();
                    $imagePath = 'images/services/' . $imageName;
                    $image->move(public_path('images/services'), $imageName);
                    $service->images()->create(['name' => $imageName]);
                }
            }
            return response()->json(new ServiceResource($service), 201);
        } catch (Exception $e) {
            \Log::error('Error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $service = Service::with('offersServices', 'subCategory', 'brand', 'locations', 'reviews', 'aboutDeals', 'images')
                ->findOrFail($id);

            return new ServiceResource($service);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, string $id)
    {
        $user = auth('brand')->user();

        if (!$user || !$user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description' => 'required|string',
            'mainImage' => 'nullable|file|mimes:jpg,jpeg,png|max:5000',
            'highlight' => 'nullable|string',
            'sub_category_id' => 'required|exists:subcategories,id',
            'locations' => 'nullable|array',
            'locations.*.name' => 'required|string',
            'locations.*.longitude' => 'required|string',
            'locations.*.latitude' => 'required|string',
            'about_deals' => 'nullable|array',
            'about_deals.*.answer' => 'required|string',
            'about_deals.*.question' => 'required|string',
            'images' => 'nullable|array',
            'images.*' => 'file|mimes:jpg,jpeg,png|max:5000',
        ]);

        try {
            $service = Service::findOrFail($id);

            $service->update([
                'name_ar' => $validatedData['name_ar'],
                'name_en' => $validatedData['name_en'],
                'description' => $validatedData['description'],
                'highlight' => $validatedData['highlight'],
                'sub_category_id' => $validatedData['sub_category_id'],
            ]);

            // Update main image if provided
            if ($request->hasFile('mainImage')) {
                $mainImage = $request->file('mainImage');
                $mainImageName = time() . '_' . $mainImage->getClientOriginalName();
                $mainImagePath = 'images/services/' . $mainImageName;
                $mainImage->move(public_path('images/services'), $mainImageName);
                $service->update(['mainImage' => $mainImageName]);
            }

            // Update locations
            if (isset($validatedData['locations'])) {
                $service->locations()->delete();
                foreach ($validatedData['locations'] as $locationData) {
                    $service->locations()->create($locationData);
                }
            }

            // Update about deals
            if (isset($validatedData['about_deals'])) {
                $service->aboutDeals()->delete();
                foreach ($validatedData['about_deals'] as $dealData) {
                    $service->aboutDeals()->create($dealData);
                }
            }

            // Update additional images
            if ($request->hasFile('images')) {
                $service->images()->delete();
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $imagePath = 'images/services/' . $imageName;
                    $image->move(public_path('images/services'), $imageName);
                    $service->images()->create(['name' => $imageName]);
                }
            }

            return response()->json(new ServiceResource($service), 200);
        } catch (Exception $e) {
            \Log::error('Error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the service.'], 500);
        }
    }






    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = auth('brand')->user();
            if (!$user || !$user->id) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            $service = Service::findOrFail($id);

            if ($user->id !== $service->brand_id) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $service->delete();

            return response()->json(['message' => 'Service deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function search(Request $request)
    {
        $name = $request->input('name');

        if (!$name) {
            return response()->json(['message' => 'No search term provided'], 400);
        }

        try {
            $services = Service::where('name_ar', 'LIKE', "%{$name}%")
                ->orWhere('name_en', 'LIKE', "%{$name}%")
                ->paginate(10);

            if ($services->isEmpty()) {
                return response()->json(['message' => 'No services found'], 404);
            }

            return AllServiceResource::collection($services);
        } catch (Exception $e) {
            \Log::error('Search Error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred during the search.'], 500);
        }
    }







}
