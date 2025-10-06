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
      User::factory(10)->create();

        // Crea un usuario específico que conozcamos para poder probar el login.
        User::factory()->create([
            'name' => 'Test Trucker',
            'email' => 'test@example.com',
        ]);
    }
}
