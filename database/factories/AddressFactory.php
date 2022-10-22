<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'line1' => $this->faker->buildingNumber(),
            'line2' => $this->faker->streetName(),
            'line3' => $this->faker->city(),
            'line4' => $this->faker->state(),
            'postalcode' => $this->faker->postcode(),
        ];
    }
}
