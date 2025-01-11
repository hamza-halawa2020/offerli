<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Advertise;
use Exception;


class AdvertiseController extends Controller
{

    public function index()
    {
        try {
            $advertises = Advertise::all();
            return response()->json($advertises);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }

    }

    public function show($id)
    {
        try {
            $advertise = Advertise::findOrFail($id);
            return response()->json($advertise);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }

    }
}
