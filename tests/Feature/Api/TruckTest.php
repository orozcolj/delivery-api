<?php
namespace Tests\Feature\Api;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Truck;
class TruckTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_admin_can_list_trucks()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Truck::factory(5)->create();
        $response = $this->actingAs($admin)->getJson('/api/trucks');
        $response->assertStatus(200);
        $response->assertJsonStructure(['data', 'links', 'meta']);
        $response->assertJsonCount(5, 'data');
    }

    /** @test */
    public function paginated_trucks_are_returned()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Truck::factory(15)->create();
        $response = $this->actingAs($admin)->getJson('/api/trucks');
        $response->assertStatus(200);
        $response->assertJsonStructure(['data', 'links', 'meta']);
        $this->assertEquals(10, count($response->json('data'))); // Paginación por 10
    }
}
