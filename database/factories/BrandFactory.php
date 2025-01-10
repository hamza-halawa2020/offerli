<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
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
          'address'    => $this->faker->address(),
          'email'    => $this->faker->email(),
          'percentage'    => $this->faker->numberBetween(10,50),
          'description'    => $this->faker->text(),
          'vat_no'    => '316245678945613',
          'Com_Reg_No'    => '01010101010',
          'other_fee'    => '50',
          'active'    => 1,
          'password' => bcrypt('password'),

        ];
    }
}
