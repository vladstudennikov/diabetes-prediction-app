<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\PhysActivityData;

class PhysActivityControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_creates_activity()
    {
        $user = User::factory()->create();
        $data = [
            'date' => now()->toDateString(),
            'duration' => 30,
            'activity_name' => 'Running',
        ];

        $response = $this->actingAs($user)->postJson('/phys-activities', $data);

        $response->assertStatus(200)
                 ->assertJsonStructure(['message', 'activity' => ['id', 'user_id', 'date', 'duration', 'activity_name']]);

        $this->assertDatabaseHas('phys_activity_data', [
            'user_id' => $user->id,
            'activity_name' => 'Running',
        ]);
    }

    public function test_index_returns_user_activities()
    {
        $user = User::factory()->create();
        PhysActivityData::factory()->count(2)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->getJson('/phys-activities');

        $response->assertStatus(200)
                 ->assertJsonCount(2);
    }
}
