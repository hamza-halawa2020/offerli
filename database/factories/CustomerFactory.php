<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
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
          'slug'    => $this->faker->slug(),
          'phone'    => $this->faker->phoneNumber(),
          'email'    => $this->faker->email(),
          'wallet'    => 100,
          'address'    => $this->faker->address(),
          'latitude'    => $this->faker->phoneNumber(),
          'longitude'    => $this->faker->phoneNumber(),
          'password' => bcrypt('password'),
        ];
    }
}
