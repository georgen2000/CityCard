<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $cities = City::all();
        return view('admin.cities.index', ['cities'=> $cities ? $cities->toArray(): []]);
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);
        $city = new City($validatedData);
        $city->save();
        return Redirect::route('cities.create')->with('status', 'city-created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $city = City::find($id);
        if (!$city) return Redirect::route('cities.index');
        return view('admin.cities.edit', ['city'=>$city->toArray()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);
        City::find($id)->update($validatedData);
        return Redirect::route('cities.edit', ['city'=>$id] )->with('status', 'city-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return City::destroy($id);
    }
}
