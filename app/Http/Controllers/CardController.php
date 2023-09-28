<?php

namespace App\Http\Controllers;

use App\Filters\CardFilter;
use App\Http\Requests\CardCreateRequest;
use App\Http\Requests\CardFilterRequest;
use App\Http\Requests\CardStoreRequest;
use App\Models\Card;
use App\Models\City;
use App\Models\CardType;
use App\Models\Transaction;
use App\Models\Transport;
use Illuminate\Support\Facades\Redirect;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CardFilterRequest $request)
    {
        $user = auth()->user();

        $filter = new CardFilter(Card::class);

        $cards = $filter->apply($request->validated())->where('user_id', $user->id)
            ->orderByRaw('card_type_id is null asc')
            ->orderBy('balance', 'desc')
            ->paginate(5);

        $cards->load(['cardType.city', 'cardType.transport']);


        $transports = Transport::all();
        $cities = City::all();

        return view('user.dashboard', [
            'cards' => $cards,
            'cities' => $cities,
            'transports' => $transports,
        ]);
    }

    public function history(Card $card)
    {
        $transactions = Transaction::where("card_id", $card->id)->cursorPaginate(5);
        return view('user.transactions', ['transactions' => $transactions]);
    }

    public function create(CardCreateRequest $request)
    {
        $user = auth()->user();
        $cityId = $request->get('city');

        if (isset($cityId)) {
            $city = City::find($cityId);

            $cardTypes = CardType::select("transport_id")
                ->where('user_category_id', $user->user_category_id)
                ->where('city_id', $cityId);
            $transports = Transport::whereIn('id', $cardTypes)->get();

            return view('user.card_create', [
                'city' => $city,
                'transports' => $transports,
            ]);
        } else {
            $cities = City::all();

            return view('user.card_create', [
                'cities' => $cities,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CardStoreRequest $request)
    {
        $user = auth()->user();
        $cityId = $request->get('city');
        $transportId = $request->get('transport');
        $cardType = CardType::select('id')
            ->where('user_category_id', $user->user_category_id)
            ->where('city_id', $cityId)
            ->where('transport_id', $transportId)
            ->first();
        $data = [
            "user_id" => $user->id,
            "number" => fake()->numerify('##########'),
            "card_type_id" => $cardType->id,
        ];
        $card = new Card($data);
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
