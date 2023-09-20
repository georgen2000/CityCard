<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\CardType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $cards = $user->cards->flatMap(function ($card) {
            return [$card->getShowFields()];
        })->all();
        $card_types = CardType::get()->where('user_category_id', $user->user_category_id)->flatMap(
            function ($card_type) {
                return [[
                    'id' => $card_type->id,
                    'city' => $card_type->city->name,
                    'transport' => $card_type->transport->name,
                ]];
            }
        );
        return view('user.dashboard', ['cards' => $cards, 'card_types' => $card_types]);
    }

    public function history($card_id)
    {
        $card =  Card::find($card_id);
        if (!$card || !$card->transactions){
            return Redirect::route('dashboard');
        }
        $trans = $card->transactions;
        return view('user.transactions', ['transactions' => $card->transactions->flatMap(function ($trans) {
            return [[
                'money_count' => $trans->is_spending ? "-" . $trans->money_count : "+" . $trans->money_count,
                'created_at' => $trans->created_at,
            ]];
        })]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'card_type_id' => ['required', 'integer'],
        ]);
        $data = [
            "user_id" => auth()->user()->id,
            "number" => fake()->numerify('##########'),
        ];
        $card = new Card($data + $validatedData);
        $card->save();
        return Redirect::route('dashboard')->with('status', 'card-created');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Card::destroy($id);
    }
}
