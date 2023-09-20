<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\UserCategory;
use \App\Models\Transport;
use \App\Models\City;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CardType>
 */
class CardTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => fake()->randomNumber(2),
            'user_category_id' => UserCategory::factory(),
            'transport_id' => Transport::factory(),
            'city_id' => City::factory(),
        ];
    }
}
