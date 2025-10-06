<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trucker;
use App\Models\Package;
use App\Models\PackageStatus;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $truckers = Trucker::all();
        $statuses = PackageStatus::all();

        foreach ($truckers as $trucker) {
            
            Package::factory(rand(2, 5))->create([
                
                'trucker_id' => $trucker->id,
                'package_status_id' => $statuses->random()->id,
            ]);
        }
    }
}
