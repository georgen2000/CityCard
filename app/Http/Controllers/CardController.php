<?php

namespace App\Http\Controllers;

use App\Filters\CardFilter;
use App\Http\Requests\CardFilterRequest;
use App\Http\Requests\CardRequest;
use App\Models\Card;
use App\Models\City;
use App\Models\CardType;
use App\Models\Transaction;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CardFilterRequest $request)
    {
        $user = auth()->user();

        $filter = new CardFilter($request->validated());
        $cards = Card::where('user_id', $user->id)
            ->filter($filter)
            ->orderByRaw('card_type_id is null asc')
            ->orderBy('balance', 'desc')
            ->paginate(5);

        $cards->load(['cardType.city', 'cardType.transport']);

        $cardTypes = CardType::where('user_category_id', $user->user_category_id)->get()
            ->loadMissing(['city', 'transport']);

        $transports = Transport::all();
        $cities = City::all();

        return view('user.dashboard', [
            'cards' => $cards,
            'cardTypes' => $cardTypes,
            'cities' => $cities,
            'transports' => $transports,
        ]);
    }

    public function history(Card $card)
    {
        $transactions = Transaction::where("card_id", $card->id)->cursorPaginate(5);
        return view('user.transactions', ['transactions' => $transactions]);
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
