<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CustomerAuthController extends Controller
{


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $customer = Customer::where('email', $credentials['email'])->first();

        if (!$customer || !Hash::check($credentials['password'], $customer->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        } else {
            $token = $customer->createToken('customer-token')->plainTextToken;
            return response()->json(['token' => $token, 'name' => $customer->name], 200);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'name_ar' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'device_token' => 'required',
        ]);

        $image = $request->file('picture');
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $folderPath = 'images/customer/';
        $image->move(public_path($folderPath), $filename);

        $customer = Customer::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request['name']),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'device_token' => $request->input('device_token'),
            'picture' => $filename,
            'password' => Hash::make($request->input('password')),
            'wallet' => 0,
        ]);

        $token = $customer->createToken('customer-token')->plainTextToken;

        return response()->json(['token' => $token, 'name' => $customer->name], 201);
    }



    public function updatePassword(Request $request)
    {
        // Validate the password input
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        // Get the currently authenticated customer
        $customer = auth('customer')->user();

        if (!$customer) {
            return response()->json([
                'error' => 'User not authenticated',
            ], 401);
        }

        // Update the customer's password
        $customer->update(['password' => Hash::make($request->password)]);

        return response()->json([
            'message' => 'Password changed successfully',
        ], 200);
    }




    public function logout(Request $request)
    {
        $customer = auth('customer')->user();

        if ($customer) {
            $customer->tokens()->delete();
            return response()->json(['message' => 'Logged Out'], 200);
        }

        return response()->json(['message' => 'Customer not authenticated'], 401);
    }



    public function updateProfile(Request $request)
    {
        // Get the currently authenticated customer
        $customer = auth('customer')->user();

        // Validate input with email unique check excluding the current customer
        $request->validate([
            'name' => 'sometimes|required|string',
            'name_ar' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:customers,email,' . $customer->id,
            'picture' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'sometimes|required',
            'latitude' => 'sometimes|required',
            'longitude' => 'sometimes|required',
            'device_token' => 'sometimes|required',
        ]);

        // Get the input data and exclude the password field if not being updated
        $input = $request->except(['password', 'picture']);

        // Handle picture update if a new picture is provided
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $folderPath = 'images/picture/';
            $image->move(public_path($folderPath), $imageName);

            // Delete the old image if it exists and is not the default
            if ($customer->picture && $customer->picture != 'default.png') {
                $oldImagePath = public_path($folderPath . $customer->picture);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Save the new image path
            $input['picture'] = $folderPath . $imageName;
        }

        // Update the customer's data
        $customer->update($input);

        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => $customer->fresh(), // return updated data
        ], 200);
    }


    public function deleteAccount(Request $request)
    {
        $customer = auth('customer')->user();

        if (!$customer) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $customer->delete();

        return response()->json(['message' => 'Account deleted successfully'], 200);
    }




    public function updatetoken(Request $request)
    {
        $request->validate([
            'device_token' => 'required',
        ]);
        $customer = auth('customer')->user();
        $customer->update(['device_token' => $request->device_token]);
        return response()->json([
            'message' => 'Successfully updated'
        ], 200);
    }
}
