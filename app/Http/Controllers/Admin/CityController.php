<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.cities.index', ['cities'=> City::paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        $city = new City($request->validated());  # todo
        $city->save();
        return Redirect::route('cities.create')->with('status', 'city-created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city) {
        return view('admin.cities.edit', ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, City $city)
    {
        $city->update($request->validated());
        return Redirect::route('cities.edit', $city)->with('status', 'city-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return City::destroy($id);
    }
}
