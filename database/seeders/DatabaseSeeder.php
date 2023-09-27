<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\City;
use App\Models\UserCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use \App\Models\User;
use \App\Models\Card;
use \App\Models\Transaction;
use \App\Models\CardType;
use App\Models\Transport;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CitySeeder::class,
            TransportSeeder::class,
            UserCategorySeeder::class,

            UserSeeder::class,
            CardTypeSeeder::class,

            CardSeeder::class,
        ]);
    }
}
