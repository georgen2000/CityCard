<?php

namespace Database\Seeders;

use App\Models\CardType;
use App\Models\City;
use App\Models\Transport;
use App\Models\UserCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userCategories = UserCategory::get("id");
        $transports = Transport::get("id");
        $cities = City::get("id");
        $cardTypeInsertArray = [];
        foreach ($transports as $transport) {
            foreach ($userCategories as $userCategory) {
                foreach ($cities as $city) {
                    $cardTypeInsertArray[] = [
                        'price' => fake()->randomNumber(2),
                        'city_id' => $city->id,
                        'transport_id' => $transport->id,
                        'user_category_id' => $userCategory->id,
                    ];
                }
            }
        }
        $cardTypes = CardType::insert($cardTypeInsertArray);
    }
}
