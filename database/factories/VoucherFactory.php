<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'code'     => $this->faker->name(),
          'title'     => $this->faker->name(),
          'slug'    => $this->faker->slug(),
          'discount'    => $this->faker->numberBetween(1,5),
          'expire_at'    => $this->faker->date(),
          'price' => $this->faker->numberBetween(10,500),
          'subcategory_id' => $this->faker->numberBetween(1,10),
          'brand_id'   => $this->faker->unique()->numberBetween(1, 15),
          'active'   => 1,
          'limit' => $this->faker->numberBetween(1,10),
        ];
    }
}
