<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Package;
use App\Models\PackageStatus;
use App\Models\MerchandiseType;

class PackageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_list_only_their_packages()
    {
        // Arrange
        $userA = User::factory()->create();
        $truckerA = \App\Models\Trucker::factory()->create(['user_id' => $userA->id]);
        $userB = User::factory()->create();
        $truckerB = \App\Models\Trucker::factory()->create(['user_id' => $userB->id]);
        $status = PackageStatus::factory()->create();
        MerchandiseType::factory()->create(); // <-- CORRECCIÓN

        Package::factory(3)->create([
            'trucker_id' => $truckerA->id,
            'package_status_id' => $status->id,
        ]);
        Package::factory(2)->create([
            'trucker_id' => $truckerB->id,
            'package_status_id' => $status->id,
        ]);
        
        // Act
        $response = $this->actingAs($userA)->getJson('/api/packages');
        
        // Assert
        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
    }
    
    /** @test */
    public function an_authenticated_user_can_create_a_package()
    {
        // Arrange
        $user = User::factory()->create();
        $trucker = \App\Models\Trucker::factory()->create(['user_id' => $user->id]);
        $status = PackageStatus::factory()->create();
        $type = MerchandiseType::factory()->create(); // <-- CORRECCIÓN (aunque ya estaba bien aquí)
        
        $packageData = [
            'address' => '123 Fake St',
            'package_status_id' => $status->id,
            'dimensions' => 'Medium',
            'weight' => '5 kg',
            'merchandise_type_id' => $type->id,
        ];
        
        // Act
        $response = $this->actingAs($user)->postJson('/api/packages', $packageData);
        
        // Assert
        $response->assertStatus(201);
        $this->assertDatabaseHas('packages', [
            'address' => '123 Fake St',
            'trucker_id' => $trucker->id
        ]);
    }

    /** @test */
    public function an_authenticated_user_can_update_their_own_package()
    {
        // Arrange
        $user = User::factory()->create();
        $trucker = \App\Models\Trucker::factory()->create(['user_id' => $user->id]);
        $status = PackageStatus::factory()->create();
        MerchandiseType::factory()->create(); // <-- CORRECCIÓN
        $package = Package::factory()->create([
            'trucker_id' => $trucker->id,
            'package_status_id' => $status->id,
        ]);

        $updateData = ['address' => '456 New Address'];

        // Act
        $response = $this->actingAs($user)->putJson('/api/packages/' . $package->id, $updateData);

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('packages', [
            'id' => $package->id,
            'address' => '456 New Address'
        ]);
    }

    /** @test */
    public function an_authenticated_user_cannot_update_another_users_package()
    {
        // Arrange
        $userA = User::factory()->create();
        $truckerA = \App\Models\Trucker::factory()->create(['user_id' => $userA->id]);
        $userB = User::factory()->create();
        $truckerB = \App\Models\Trucker::factory()->create(['user_id' => $userB->id]);
        $status = PackageStatus::factory()->create();
        MerchandiseType::factory()->create(); // <-- CORRECCIÓN
        $packageOfUserB = Package::factory()->create([
            'trucker_id' => $truckerB->id,
            'package_status_id' => $status->id,
        ]);
        
        // Act
        $response = $this->actingAs($userA)->putJson('/api/packages/' . $packageOfUserB->id, ['address' => 'Hacked']);
        
        // Assert
        $response->assertStatus(403);
    }
    
    /** @test */
    public function an_authenticated_user_can_delete_their_own_package()
    {
        // Arrange
        $user = User::factory()->create();
        $trucker = \App\Models\Trucker::factory()->create(['user_id' => $user->id]);
        $status = PackageStatus::factory()->create();
        MerchandiseType::factory()->create(); // <-- CORRECCIÓN
        $package = Package::factory()->create([
            'trucker_id' => $trucker->id,
            'package_status_id' => $status->id,
        ]);

        // Act
        $response = $this->actingAs($user)->deleteJson('/api/packages/' . $package->id);

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseMissing('packages', ['id' => $package->id]);
    }
}