<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Kutia\Larafirebase\Facades\Larafirebase;

class PushController extends Controller
{
    public function index()
    {
        return view('dashboard.push');
    }
    public function push(Request $request)
    {
        $title = $request->input('title');
        $body = $request->input('content');

        DB::table('customers')
            ->whereNotNull('device_token')
            ->orderBy('id') // Add an orderBy clause
            ->chunk(100, function ($customers) use ($title, $body) {
                foreach ($customers as $customer) {
                    // Sending notification using Larafirebase
                    Larafirebase::fromArray(['title' => $title, 'body' => $body])
                        ->sendNotification($customer->device_token);
                }
            });

        return redirect()->route('notifications');
    }
}
