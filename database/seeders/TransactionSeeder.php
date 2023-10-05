<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{

    const COUNT = 250;
    const MAX_COUNT = 1000;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cards = Card::select("id")->get();

        $count = 0;
        $all_count = 0;

        // $secquence = [];
        // foreach ($cards as $card) {
        //     $count += self::COUNT;
        //     $all_count += self::COUNT;
        //     $secquence[] = [
        //         'card_id' => $card->id,
        //     ];

        //     if ($count >= self::MAX_COUNT) {
        //         print_r("Count: " . $count);
        //         Transaction::factory()->count($count)->sequence(...$secquence)->create();
        //         print_r("All Count: " . $all_count);

        //         $secquence = [];
        //         $count = 0;
        //     }
        // }
        // print_r("Count: " . $count);
        // Transaction::factory()->count($count)->sequence(...$secquence)->create();
        // print_r("All Count: " . $all_count);

        $insertArray = [];
        foreach ($cards as $card) {
            $count += self::COUNT;
            $all_count += self::COUNT;
            for ($i = 0; $i < self::COUNT; $i++) {
                $insertArray[]  = [
                    'money_count' => fake()->randomFloat(2, 100, 500),
                    'is_spending' => fake()->boolean(),
                    'card_id' => $card->id,
                ];
            }
            if ($count >= self::MAX_COUNT) {
                print_r("Count: " . $count . "\n");
                Transaction::insert($insertArray);
                print_r("All Count: " . $all_count . "\n");

                $insertArray = [];
                $count = 0;
            }
        }

        print_r("Count: " . $count . "\n");
        Transaction::insert($insertArray);
        print_r("All Count: " . $all_count . "\n");
    }
}
