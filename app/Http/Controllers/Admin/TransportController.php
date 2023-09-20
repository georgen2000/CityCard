<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transport;
use Illuminate\Support\Facades\Redirect;


class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transports = Transport::all();
        return view('admin.transports.index', ['transports'=> $transports? $transports->toArray(): []]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.transports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);
        $transport = new Transport($validatedData);
        $transport->save();
        return Redirect::route('transports.create')->with('status', 'transport-created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transport = Transport::find($id);
        if (!$transport) return Redirect::route('transports.index');
        return view('admin.transports.edit', ['transport'=> $transport->toArray()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);
        Transport::find($id)->update($validatedData);
        return Redirect::route('transports.edit', ['transport'=>$id] )->with('status', 'transport-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Transport::destroy($id);
    }
}
