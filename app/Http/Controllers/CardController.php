<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardRequest;
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
        $cardTypes = CardType::get()->where('user_category_id', $user->user_category_id)
            ->loadMissing(['city', 'transport']);
        return view('user.dashboard', ['cards' => $user->cards->sortByDesc('card_type_id'), 'card_types' => $cardTypes]);
    }

    public function history(Card $card)
    {
        return view('user.transactions', ['transactions' => $card->transactions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CardRequest $request)
    {
        $data = [ # maybe should use factory?
            "user_id" => auth()->user()->id,
            "number" => fake()->numerify('##########'),
        ];
        $card = new Card($data + $request->validated());
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
