<?php

namespace Database\Seeders;

use App\Models\Transport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Card;
use App\Models\CardType;
use App\Models\City;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserCategory;
use Illuminate\Database\Eloquent\Factories\Sequence;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // My awry code))


        $users = User::factory(2)->state(
            new Sequence(
                ['is_admin' => true],
                ['is_admin' => false],
            ),
            ['user_category_id' => "",]

        )->create();

        Card::insert([
            'number' => fake()->numerify('##########'),
            'balance' => 0,
            'card_type_id' => CardType::factory(),
            'user_id' => ''
        ]);

        User::factory(1)->create([
            'is_admin' => true,
        ]);
        UserCategory::factory(5)->has(
            User::factory(10)->has(
                Card::factory(5)->for(
                    CardType::factory()->state([
                        'price' => fake()->randomNumber(2),
                    ])
                )->state([
                    'number' => fake()->numerify('##########'),
                    'balance' => 0,

                    'card_type_id' => "", # TODO CardType, City< Transport
                ])
            )->state([
                'is_admin' => false,
            ])
        )->state(
            new Sequence([
                ["name" => "Користувач"],
                ["name" => "Студент"],
                ["name" => "Школяр"],
                ["name" => "Пенсіонер"],
                ["name" => "Інвалід"],
            ])
        )->create();

        Card::factory(5)->has(Transaction::factory()->count(2))->create([
            'user_id' => $users[1]->id,
            'card_type_id' => CardType::factory()->create([
                'user_category_id' => $users[1]->user_category_id,
            ]),
        ])->each(function ($card) {
            $card->setBalance();
        });
        fake()->randomNumber(2);
        $cardTypes = 'CardType';

        $transports = Transport::factory(2)->state(
            new Sequence(
                [
                    ["name" => "Автобус"],
                    ["name" => "Маршрутка"],
                ]
            )
        )->create();

        $userCategories = UserCategory::factory(5)->state(
            new Sequence(
                [
                    ["name" => "Користувач"],
                    ["name" => "Студент"],
                    ["name" => "Школяр"],
                    ["name" => "Пенсіонер"],
                    ["name" => "Інвалід"],
                ]
            )
        )->create();

        $cities = City::factory(10)->create();


        $cardTypeInsertArray = [];
        foreach ($transports as $transport) {
            foreach ($userCategories as $userCategory) {
                foreach ($cities as $city) {
                    $cardTypeInsertArray[$userCategory->id][] = [
                        'price' => fake()->randomNumber(2),
                        'city_id' => $city->id,
                        'transport_id' => $transport->id,
                        'user_category_id' => $userCategory->id,
                    ];
                }
            }
        }
        $cardTypes = CardType::insert($cardTypeInsertArray); #todo make [][][] to [][]

        // foreach ($cardTypes as $cardType){
        //     foreach ()
        // }
        foreach ($userCategories as $userCategory) {
            User::factory(10)->has(
                Card::factory(5)->has(
                    Transaction::factory()->count(2)
                )->state([
                    'card_type_id' => ""
                ])->each(function ($card) {
                    $card->setBalance();
                })
            )->create([
                'user_category_id' => $userCategory->id,
                'is_admin' => false
            ]);
        }
    }
}
