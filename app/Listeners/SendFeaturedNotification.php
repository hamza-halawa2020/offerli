<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\BrandFeatured;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\FeatureNotification;

class SendFeaturedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BrandFeatured $event): void
    {
        $brand = $event->brand;
        Notification::send(User::first(), new FeatureNotification($brand));
    }
}
