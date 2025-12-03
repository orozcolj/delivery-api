<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class TruckerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 155 usuarios y sus truckers asociados
        \App\Models\User::factory(155)->create()->each(function ($user) {
            \App\Models\Trucker::factory()->create([
                'user_id' => $user->id,
                'first_name' => explode(' ', $user->name)[0],
                'last_name' => fake()->lastName(),
                'document' => fake()->numerify('#########'),
                'birth_date' => fake()->date('Y-m-d', '2000-01-01'),
                'license_number' => fake()->bothify('C##-#####'),
                'phone' => fake()->numerify('3#########'),
            ]);
        });
    }
}
