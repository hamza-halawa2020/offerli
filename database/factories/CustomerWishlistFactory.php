<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerWishlist>
 */
class CustomerWishlistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id'  => $this->faker->numberBetween(1, 10),
            'voucher_id'   => $this->faker->numberBetween(1, 10)
        ];
    }
}
