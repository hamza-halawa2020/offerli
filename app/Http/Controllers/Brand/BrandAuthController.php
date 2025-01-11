<?php

namespace App\Http\Controllers\Brand;

use App\Models\Brand;
use Illuminate\Support\Str;

use App\Events\BrandCreated;
use Illuminate\Support\Facades\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Exception;
use Log;
class BrandAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $brand = Brand::where('email', $credentials['email'])->first();

        if (!$brand || !Hash::check($credentials['password'], $brand->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        } else {
            $token = $brand->createToken('brand-token')->plainTextToken;
            return response()->json(['token' => $token, 'name' => $brand->name], 200);
        }
    }





    public function register(Request $request)
    {
        try {
            Log::info('Validation started');

            $request->validate([
                'name' => 'required|string',
                'name_ar' => 'required|string',
                'email' => 'required|email|unique:brands,email',
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'password' => 'required|min:6|confirmed',
                'vat_no' => 'required',
                'com_reg_no' => 'required',
                'phone' => 'required',
                'device_token' => 'required',
            ]);

            Log::info('Validation passed');

            $image = $request->file('logo');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $folderPath = 'images/brand/';
            $image->move(public_path($folderPath), $filename);

            Log::info('Image uploaded: ' . $filename);

            // Create brand
            $brand = Brand::create([
                'name' => $request->name,
                'name_ar' => $request->name_ar,
                'slug' => Str::slug($request->name),
                'email' => $request->email,
                'phone' => $request->phone,
                'vat_no' => $request->vat_no,
                'description' => $request->description,
                'com_reg_no' => $request->com_reg_no,
                'device_token' => $request->device_token,
                'logo' => $filename,
                'password' => Hash::make($request->password),
                'wallet' => 0,
            ]);

            Log::info('Brand created successfully: ' . $brand->id);

            $token = $brand->createToken('brand-token')->plainTextToken;

            // Trigger event
            Event::dispatch(new BrandCreated($brand));

            return response()->json(['token' => $token, 'name' => $brand->name], 201);
        } catch (Exception $e) {
            Log::error('Error during registration: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while trying to register'], 500);
        }
    }



    public function updatepassword(Request $request)
    {

        $request->validate([
            'password' => 'required | min:8|confirmed',
        ]);
        $brand = auth('brand')->user();
        if (!$brand) {
            return response()->json([
                'error' => 'Brand not authenticated',
            ], 401);
        }

        $brand->update(['password' => Hash::make($request->password)]);

        return response()->json([
            'message' => 'Password changed successfully',
        ], 200);
    }
    public function logout(Request $request)
    {
        $barnd = auth('brand')->user();

        if ($barnd) {
            $barnd->tokens()->delete();
            return response()->json(['message' => 'Logged Out'], 200);
        }

        return response()->json(['message' => 'Brand not authenticated'], 401);
    }



    public function updateprofile(Request $request)
    {
        $brand = auth('brand')->user();

        $request->validate([
            'name' => 'string',
            'name_ar' => 'string',
            'email' => 'email|unique:brands,email,' . $brand->id, // Allow the current brand's email
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'vat_no' => 'string',
            'com_reg_no' => 'string',
            'phone' => 'string',
            'device_token' => 'string',
        ]);



        $input = $request->except(['password', 'logo']);

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');

            // Generate a unique name for the image
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $folderPath = 'images/brand/';

            // Move the image to the public directory
            $image->move(public_path($folderPath), $imageName);

            // Delete the old image if it exists and is not the default
            if ($brand->logo && $brand->logo != 'default.png') {
                $oldImagePath = public_path($folderPath . $brand->logo);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Save the new image path
            $input['logo'] = $folderPath . $imageName;
        }

        $brand->update($input);

        return response()->json([
            'message' => 'Profile updated successfully',
            'brand' => $brand,
        ], 200);
    }

    public function updatetoken(Request $request)
    {
        $request->validate([

            'device_token' => 'required',
        ]);
        $barnd = auth('brand')->user();
        $barnd->update(['device_token' => $request->device_token]);
        return response()->json([
            'message' => 'Successfully updated'
        ], 200);
    }

    public function deleteAccount(Request $request)
    {
        $barnd = auth('brand')->user();


        if (!$barnd) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $barnd->delete();
        return response()->json(['message' => 'Account deleted successfully'], 200);
    }

}
