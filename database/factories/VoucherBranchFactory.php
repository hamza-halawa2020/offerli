<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Branch;
use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CouponBranch>
 */
class VoucherBranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'voucher_id'  => $this->faker->numberBetween(1, 10),
          'branch_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
