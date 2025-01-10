<?php

namespace Database\Factories;

use App\Models\Coupon;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerCoupon>
 */
class CustomerVoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = now();
        $endDate = now()->addDays(100);
        return [
            'customer_id'  => $this->faker->numberBetween(1, 10),
            'code' => Str::random(8),
            'voucher_id'   => $this->faker->numberBetween(1, 10),
            'branch_id'   => $this->faker->numberBetween(1, 10),
            'payment_id'   => $this->faker->numberBetween(1, 2),
            'paid_price'   => $this->faker->numberBetween(50, 200),
            // 'profit'   => $this->faker->numberBetween(10, 100),
            // 'tax'   => $this->faker->numberBetween(7, 30),
            'expire_at' => $this->faker->dateTimeBetween($startDate, $endDate),
            // 'invoice_id'   => 0,
            'rating'   => 5,
            'rating_comment'   => $this->faker->name(),
            'status_id'  => 1,
        ];
    }
}
