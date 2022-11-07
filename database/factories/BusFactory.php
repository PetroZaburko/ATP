<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->regexify('[A-Z]{3}[0-9]{4}'),
            'brand_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}
