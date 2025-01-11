<?php

namespace App\Providers;

use App\Events\BrandCreated;
use App\Events\BrandFeatured;
use App\Events\VoucherCreated;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendBrandNotification;
use App\Listeners\SendVoucherNotification;
use App\Listeners\SendFeaturedNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        BrandCreated::class => [
            SendBrandNotification::class,
        ],
        VoucherCreated::class => [
            SendVoucherNotification::class,
        ],
        BrandFeatured::class => [
            SendFeaturedNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
