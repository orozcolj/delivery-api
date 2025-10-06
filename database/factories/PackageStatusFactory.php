<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PackageStatusFactory extends Factory
{
    public function definition(): array
    {
        return [
            'status' => fake()->word(),
        ];
    }
}