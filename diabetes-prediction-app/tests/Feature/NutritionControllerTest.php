<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\NutritionData;

class NutritionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_creates_meal()
    {
        $user = User::factory()->create();
        $data = [
            'date' => now()->toDateString(),
            'meal_name' => 'Banana',
            'dish_name' => 'Сніданок',
        ];

        $response = $this->actingAs($user)->postJson('/nutrition', $data);

        $response->assertStatus(200)
                 ->assertJsonStructure(['message', 'meal' => ['id', 'user_id', 'date', 'meal_name', 'dish_name']]);

        $this->assertDatabaseHas('nutrition_data', [
            'user_id' => $user->id,
            'meal_name' => 'Banana',
            'dish_name' => 'Сніданок',
        ]);
    }

    public function test_index_returns_user_meals()
    {
        $user = User::factory()->create();
        NutritionData::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->getJson('/nutrition');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }
}
