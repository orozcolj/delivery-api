<?php
namespace Tests\Feature\Api;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Trucker;
use Illuminate\Support\Facades\DB;
class TruckerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_admin_can_list_truckers()
    {
        $admin = User::factory()->create(['role' => 'admin', 'email' => 'admin_' . uniqid() . '@test.com']);
        $users = User::factory(5)->sequence(fn ($sequence) => [
            'email' => 'trucker_' . $sequence->index . '_' . uniqid() . '@test.com',
            'role' => 'trucker',
        ])->create();
        $ids = [];
        foreach ($users as $user) {
            $trucker = Trucker::factory()->create(['user_id' => $user->id]);
            $ids[] = $trucker->id;
        }
        $this->assertEquals(5, Trucker::whereHas('user', function($q) {
            $q->where('role', '!=', 'admin');
        })->count()); // Verifica que existen 5 camioneros excluyendo el admin
        $response = $this->actingAs($admin)->getJson('/api/truckers?per_page=5');
        $response->assertStatus(200);
        $response->assertJsonStructure(['data', 'links', 'meta']);
        $truckers = collect($response->json('data'));
        $createdTruckers = $truckers->whereIn('id', $ids);
        $this->assertCount(5, $createdTruckers);
    }

    /** @test */
    public function paginated_truckers_are_returned()
    {
        $admin = User::factory()->create(['role' => 'admin', 'email' => 'admin_' . uniqid() . '@test.com']);
        $users = User::factory(15)->sequence(fn ($sequence) => [
            'email' => 'trucker_' . $sequence->index . '_' . uniqid() . '@test.com',
            'role' => 'trucker',
        ])->create();
        foreach ($users as $user) {
            Trucker::factory()->create(['user_id' => $user->id]);
        }
        $this->assertEquals(15, Trucker::whereHas('user', function($q) {
            $q->where('role', '!=', 'admin');
        })->count()); // Verifica que existen 15 camioneros excluyendo el admin
        $response = $this->actingAs($admin)->getJson('/api/truckers?per_page=15');
        $response->assertStatus(200);
        $response->assertJsonStructure(['data', 'links', 'meta']);
        $this->assertEquals(15, count($response->json('data'))); // Paginación por 10
    }
}
