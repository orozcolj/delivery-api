<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Tablas de catálogo primero, porque otras dependen de ellas.
            PackageStatusSeeder::class,
            MerchandiseTypeSeeder::class,
            // Luego, las entidades principales.
            TruckerSeeder::class, // Esto crea Users y Truckers
            TruckSeeder::class,   // Esto crea Trucks y los asigna
            // Finalmente, las entidades que dependen de todo lo anterior.
            PackageSeeder::class,
        ]);
    }
}
