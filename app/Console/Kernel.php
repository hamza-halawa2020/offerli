<?php

namespace App\Console;

use Log;
use App\Models\Brand;
use App\Models\Status;
use App\Models\Invoice;
use App\Models\Voucher;
use App\Models\Customer;
use App\Models\CustomerVoucher;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            // Log::info('Scheduled task is running.');
            Brand::where('featured_until', '<', now())->update(['featured_until' => null, 'featured' => 0]);
        })->daily();
        $schedule->call(function () {
            // Log::info('Scheduled task is running.');
            Customer::where('blocked_until', '<', now())->update(['blocked_until' => null, 'blocked' => 0]);
        })->daily();
        $schedule->call(function () {
            Voucher::where('expire_at', '<', now())->update(['active' => 0]);
        })->daily();
        $schedule->call(function () {
            $vouchers = CustomerVoucher::where('expire_at', '<', now())->update(['status_id' => 2]);
            foreach ($vouchers as $voucher) {
                $voucher->customer->update(['wallet' =>  $voucher->customer->wallet + $voucher->paid_price]);
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
