<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MerchandiseTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'type' => fake()->word(),
        ];
    }
}