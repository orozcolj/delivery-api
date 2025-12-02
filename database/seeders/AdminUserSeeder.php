<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin1234'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'remember_token' => \Str::random(10),
        ]);
    }
}
