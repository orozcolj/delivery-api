<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Truck;
use App\Models\Trucker;

class TruckSeeder extends Seeder
{
    public function run(): void
    {
        // Crea 15 camiones usando el factory.
        Truck::factory(15)->create();

        // Obtiene todos los conductores y camiones que ya existen.
        $truckers = Trucker::all();
        $trucks = Truck::all();

        // Para cada conductor...
        foreach ($truckers as $trucker) {
            // ...asígnale entre 1 y 3 camiones al azar.
            $trucker->trucks()->attach(
                $trucks->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
