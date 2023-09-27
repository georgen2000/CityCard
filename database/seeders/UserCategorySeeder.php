<?php

namespace Database\Seeders;

use App\Models\UserCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserCategory::insert([
            ["name" => "Користувач"],
            ["name" => "Студент"],
            ["name" => "Школяр"],
            ["name" => "Пенсіонер"],
            ["name" => "Інвалід"],
        ]);
    }
}
