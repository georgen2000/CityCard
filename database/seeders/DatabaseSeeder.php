<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use \App\Models\User;
use \App\Models\Card;
use \App\Models\Transaction;
use \App\Models\CardType;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(2)->state(
            new Sequence(
                ['is_admin' => true],
                ['is_admin' => false],
            )
        )->create();

        Card::factory(5)->has(Transaction::factory()->count(2))->create([
            'user_id' => $users[1]->id,
            'card_type_id' => CardType::factory()->create([
                'user_category_id' => $users[1]->user_category_id,
            ]),
        ])->each(function ($card){
            $card->setBalance();
        });

    }
}
