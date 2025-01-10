<?php

namespace App\Listeners;

use App\Events\BrandCreated;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;
use App\Notifications\BrandCreatedNotification;

class SendBrandNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function handle(BrandCreated $event)
    {
        $brand = $event->brand;
        Notification::send(User::first(), new BrandCreatedNotification($brand));
    }
}
