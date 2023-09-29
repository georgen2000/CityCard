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
        foreach ($users as $user) {
            $cardTypes = CardType::select("id")->where("user_category_id", $user->user_category_id)->get();
            foreach ($cardTypes as $cardType) {
                Card::factory()->has( # todo make transport seeder
                    Transaction::factory()->count(self::TRANSACTION_COUNT)
                )->create([
                    'card_type_id' => $cardType->id,
                    'user_id' => $user->id,
                ])->each(function ($card) { # todo separate function for this functionality
                    $card->setBalance();
                });
            }
        }
    }
}
