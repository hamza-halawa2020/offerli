<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'name'     => $this->faker->name(),
          'address'     => $this->faker->address(),
          'phone'    => $this->faker->phoneNumber(),
        //   'email'    => $this->faker->email(),
          'slug'    => $this->faker->slug(),
          'latitude'    => $this->faker->phoneNumber(),
          'longitude'    => $this->faker->phoneNumber(),
          'brand_id'    => $this->faker->numberBetween(1, 20),
        ];
    }
}
