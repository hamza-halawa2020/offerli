<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Events\VoucherCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\VoucherCreatedNotification;

class SendVoucherNotification
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
    public function handle(VoucherCreated $event): void
    {
        $voucher = $event->voucher;
        Notification::send(User::first(), new VoucherCreatedNotification($voucher));
    }
}
