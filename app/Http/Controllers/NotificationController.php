<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAllAsRead()
    {

        $notifications = Notification::all();

        foreach ($notifications as $notification) {
            $notification->update(['read_at' =>  now()]);
        }
        return redirect()->back();
    }
}
