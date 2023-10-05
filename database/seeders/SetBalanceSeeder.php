<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetBalanceSeeder extends Seeder
{
    const MAX_COUNT = 100;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cards = Card::limit(200)->get("id");
        $cards = Card::get("id");
        foreach ($cards as $card) {
            $card->setBalance();
        }
    }
}
