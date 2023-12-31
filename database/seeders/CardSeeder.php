<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CardType;

class CardSeeder extends Seeder
{
    const TRANSACTION_COUNT = 5;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::select("id", "user_category_id")->get();
        $cards = [];
        foreach ($users as $user) {
            $cardTypes = CardType::select("id")->where("user_category_id", $user->user_category_id)->get();

            foreach ($cardTypes as $cardType) {
                $cards[] = [
                    'number' => fake()->numerify('##########'),
                    'balance' => 0,
                    'card_type_id' => $cardType->id,
                    'user_id' => $user->id,
                ];
            }
        }
        Card::insert($cards);
    }
}
