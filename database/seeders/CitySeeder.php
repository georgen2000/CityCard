<?php

namespace Database\Seeders;


use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    const COUNT = 10;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::factory(self::COUNT)->create();
    }
}
