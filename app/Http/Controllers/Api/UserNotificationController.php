<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserNotification;
use App\Models\Customer;
use App\Http\Resources\UserNotificationResource;
use Illuminate\Http\Request;

class UserNotificationController extends Controller
{
    /**
     * Display a listing of the notifications.
     */
    public function index()
    {
        // Check for the authenticated user (brand or customer)
        $user = auth('brand')->user() ?? auth('customer')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Fetch notifications based on the user role
        $notifications = UserNotification::query()
            ->when($user->getTable() === 'brands', function ($query) use ($user) {
                $query->where('brand_id', $user->id);
            })
            ->when($user->getTable() === 'customers', function ($query) use ($user) {
                $query->where('customer_id', $user->id);
            })
            ->get();

        return UserNotificationResource::collection($notifications);
    }

    /**
     * Store a new notification. 
     */
    public function store(Request $request)
    {
        $user = auth('brand')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'image' => 'required|file|mimes:jpg,jpeg,png|max:5000', // Validate file upload
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'customer_id' => 'nullable|exists:customers,id',
            'voucher_id' => 'nullable|exists:vouchers,id',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'radius' => 'nullable|numeric|min:1', // Radius in kilometers
        ]);

        // Save the uploaded image in the public directory
        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . $image->getClientOriginalName();
        $imagePath = 'images/notifications/' . $imageName;
        $image->move(public_path('images/notifications'), $imageName);
        $validated['image'] = $imageName;

        // Check if latitude, longitude, and radius are provided to send notifications based on location
        if ($validated['latitude'] && $validated['longitude'] && $validated['radius']) {
            return $this->sendNotificationsToArea($validated, $user);
        }

        // If a specific customer is provided, send notification to them
        if ($validated['customer_id']) {
            return $this->sendNotificationToCustomer($validated, $user);
        }

        // Otherwise, send to all customers
        return $this->sendNotificationsToAllCustomers($validated, $user);
    }

    /**
     * Send notification to customers in the specified geographic area.
     */
    private function sendNotificationsToArea(array $validated, $user)
    {
        $latitude = $validated['latitude'];
        $longitude = $validated['longitude'];
        $radius = $validated['radius'];

        // Use the Haversine formula to get customers within the radius
        $customers = Customer::select('id', 'latitude', 'longitude')
            ->selectRaw(
                "(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance",
                [$latitude, $longitude, $latitude]
            )
            ->having('distance', '<=', $radius)
            ->get();

        if ($customers->isEmpty()) {
            return response()->json(['message' => 'No customers found in the specified area'], 404);
        }

        // Create notifications for all customers in the area
        $notifications = $customers->map(function ($customer) use ($validated, $user) {
            return [
                'image' => $validated['image'],
                'title' => $validated['title'],
                'description' => $validated['description'],
                'customer_id' => $customer->id,
                'voucher_id' => $validated['voucher_id'],
                'brand_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        UserNotification::insert($notifications);

        return response()->json(['message' => 'Notification sent to customers in the area'], 201);
    }

    /**
     * Send notification to a specific customer.
     */
    private function sendNotificationToCustomer(array $validated, $user)
    {
        $notification = UserNotification::create(array_merge($validated, ['brand_id' => $user->id]));
        return new UserNotificationResource($notification);
    }

    /**
     * Send notification to all customers.
     */
    private function sendNotificationsToAllCustomers(array $validated, $user)
    {
        $customers = Customer::pluck('id'); // Fetch all customer IDs

        // Create notifications for all customers
        $notifications = $customers->map(function ($customerId) use ($validated, $user) {
            return [
                'image' => $validated['image'],
                'title' => $validated['title'],
                'description' => $validated['description'],
                'customer_id' => $customerId,
                'voucher_id' => $validated['voucher_id'],
                'brand_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        UserNotification::insert($notifications);

        return response()->json(['message' => 'Notification sent to all customers'], 201);
    }

    /**
     * Mark a notification as read.
     */

    public function markAsRead($id)
    {
        $user = auth('customer')->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $notification = UserNotification::findOrFail($id);
        if ($notification->customer_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized to mark this notification as read'], 403);
        }
        if ($notification->status === 'read') {
            return response()->json(['message' => 'Notification is already marked as read'], 200);
        }
        \Log::info('Notification update data:', [
            'status' => 'read',
            'read_at' => now(),
        ]);

        $notification->update([
            'status' => 'read',
            'read_at' => now(),
        ]);
        return response()->json(['message' => 'Notification marked as read'], 200);
    }
    /**
     * Display a specific notification.
     */
    public function show($id)
    {
        $user = auth('brand')->user() ?? auth('customer')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notification = UserNotification::findOrFail($id);

        // Check if the authenticated user is authorized to view the notification
        if (
            ($user->getTable() === 'brands' && $notification->brand_id !== $user->id) ||
            ($user->getTable() === 'customers' && $notification->customer_id !== $user->id)
        ) {
            return response()->json(['error' => 'Unauthorized to view this notification'], 403);
        }

        return new UserNotificationResource($notification);
    }

    /**
     * Update a notification.
     */
    public function update(Request $request, $id)
    {
        $user = auth('brand')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notification = UserNotification::findOrFail($id);

        // Ensure the notification belongs to the authenticated brand
        if ($notification->brand_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:5000',

            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:500',
            'customer_id' => 'nullable|exists:customers,id',
            'voucher_id' => 'nullable|exists:vouchers,id',
        ]);

        // Update main image if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . $image->getClientOriginalName();
            $imagePath = 'images/notifications/' . $imageName;
            $image->move(public_path('images/notifications'), $imageName);
            $notification->update(['image' => $imageName]);
        }


        $notification->update($validated);

        return new UserNotificationResource($notification);
    }

    /**
     * Remove a specific notification.
     */
    public function destroy($id)
    {
        $user = auth('brand')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notification = UserNotification::findOrFail($id);

        // Ensure the notification belongs to the authenticated brand
        if ($notification->brand_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notification->delete();

        return response()->json(['message' => 'Notification deleted successfully'], 200);
    }
}
