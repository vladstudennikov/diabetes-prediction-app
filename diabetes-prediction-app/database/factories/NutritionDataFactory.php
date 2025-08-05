<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NutritionData>
 */
class NutritionDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),  // create or use a test user
            'date' => $this->faker->date(),
            'meal_name' => $this->faker->words(2, true),  // e.g., "Chicken Soup"
            'dish_name' => $this->faker->randomElement(['Сніданок', 'Обід', 'Вечеря', 'Перекус']),
        ];
    }
}
