<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    const COUNT = 1;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'is_admin' => true,
        ]);
        $userCategories = UserCategory::get("id");
        foreach ($userCategories as $userCategory) {
            User::factory(self::COUNT)->create([
                'is_admin' => false,
                'user_category_id' => $userCategory->id,
            ]);
        }
    }
}
