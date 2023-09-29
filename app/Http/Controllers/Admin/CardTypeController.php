<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardTypeRequest;
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
        $cardTypes = CardType::paginate(5);  # todo make all varibles CammelCase and test
        $cardTypes->load(['city', 'transport', 'userCategory']);
        return view('admin.card_types.index', ['card_types'=> $cardTypes]);
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
    public function store(CardTypeRequest $request)
    {
        $cardType = new CardType($request->validated());
        $cardType->save();
        return Redirect::route('card_types.create')->with('status', 'card-type-created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CardType $cardType)
    {
        // $cardType->load('city', 'transport', 'userCategory');
        return view('admin.card_types.edit', [
            'card_type'=> $cardType,
            'user_categgoties'=> UserCategory::all(),
            'cities'=> City::all(),
            'transports'=> Transport::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CardTypeRequest $request, CardType $cardType)
    {
        $cardType->update($request->validated());
        return Redirect::route('card_types.edit', ['card_type'=>$cardType] )->with('status', 'card-type-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return CardType::destroy($id);
    }
}
