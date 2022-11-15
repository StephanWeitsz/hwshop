<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'contacttype_id' => 1,
            'number' => $this->faker->e164PhoneNumber(),
        ];
    }
}
