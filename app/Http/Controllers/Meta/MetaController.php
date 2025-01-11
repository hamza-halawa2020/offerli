<?php

namespace App\Http\Controllers\Meta;

use App\Models\MetaData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MetaController extends Controller
{
    public function updateURLS(Request $request)
    {
        $request->validate([
            'IOS_Link' => 'required',
            'Android_Link' => 'required',
        ]);

        $metaData = MetaData::first();
        $metaData->update(['IOS_Link' => $request->IOS_Link, 'Android_Link' => $request->Android_Link]);
        return response()->json(['message' => 'Links Updated Successfully'], 200);
    }
}
