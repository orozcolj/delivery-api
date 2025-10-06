<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Package;
use App\Models\PackageDetail;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'address' => fake()->streetAddress(),
        ];}

         public function configure(): static
    {
        return $this->afterCreating(function (Package $package) {
            PackageDetail::factory()->create([
                'package_id' => $package->id,
            ]);
        });
    }
}
