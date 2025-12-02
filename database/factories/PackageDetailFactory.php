<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MerchandiseType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PackageDetail>
 */
class PackageDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            
            'merchandise_type_id' => MerchandiseType::inRandomOrder()->first()->id,
            'dimensions' => fake()->numberBetween(10, 100) . 'x' . fake()->numberBetween(10, 100) . 'x' . fake()->numberBetween(10, 100) . ' cm',
            'weight' => fake()->randomFloat(2, 1, 50) . ' kg',
            'delivery_date' => fake()->optional(0.7)->dateTimeThisMonth(),
        ];
        
    }
}
