<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MerchandiseType;

class MerchandiseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MerchandiseType::create(['type' => 'Electronics']);
        MerchandiseType::create(['type' => 'Clothing']);
        MerchandiseType::create(['type' => 'Documents']);
        MerchandiseType::create(['type' => 'Food']);
    }
}
