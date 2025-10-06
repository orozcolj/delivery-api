<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PackageStatus;

class PackageStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PackageStatus::create(['status' => 'In Warehouse']);
        PackageStatus::create(['status' => 'In Transit']);
        PackageStatus::create(['status' => 'Delivered']);
        PackageStatus::create(['status' => 'Cancelled']);
    }
}
