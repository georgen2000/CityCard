<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserCategory;
use App\Models\CardType;
use App\Models\City;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CardTypeController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $card_types = CardType::all()->each(function($card_type) {
            $card_type->city->href = route('cities.edit', $card_type->city->id);
            $card_type->transport->href = route('transports.edit', $card_type->transport->id);
            $card_type->user_category->href = route('user_categories.edit', $card_type->user_category->id);

            unset($card_type->city_id);
            unset($card_type->transport_id);
            unset($card_type->user_category_id);
        })->toArray();

        return view('admin.card_types.index', ['card_types'=> $card_types]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.card_types.create', [
            'user_categgoties'=> UserCategory::all(),
            'cities'=> City::all(),
            'transports'=> Transport::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'price' => ['required','integer'],
            'user_category_id' => ['required', 'integer'],
            'transport_id' => ['required', 'integer'],
            'city_id' => ['required', 'integer'],
        ]);
        $card_type = new CardType($validatedData);
        $card_type->save();
        return Redirect::route('card_types.create')->with('status', 'card-type-created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $card_type = CardType::find($id);
        if (!$card_type) return Redirect::route('card_types.index');
        $card_type->city;
        $card_type->transport;
        $card_type->user_category;
        return view('admin.card_types.edit', [
            'card_type'=> $card_type,
            'user_categgoties'=> UserCategory::all(),
            'cities'=> City::all(),
            'transports'=> Transport::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'price' => ['required','integer'],
            'user_category_id' => ['required', 'integer'],
            'transport_id' => ['required', 'integer'],
            'city_id' => ['required', 'integer'],
        ]);
        CardType::find($id)->update($validatedData);
        return Redirect::route('card_types.edit', ['card_type'=>$id] )->with('status', 'card-type-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return CardType::destroy($id);
    }
}
