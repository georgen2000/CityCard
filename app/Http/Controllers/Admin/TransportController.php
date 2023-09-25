<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransportRequest;
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
        return view('admin.transports.index', ['transports'=> Transport::all()]);
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
    public function store(TransportRequest $request)
    {
        $transport = new Transport($request->all());
        $transport->save();
        return Redirect::route('transports.create')->with('status', 'transport-created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transport $transport)
    {
        return view('admin.transports.edit', ['transport'=> $transport]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransportRequest $request, Transport $transport)
    {
        $transport->update($request->all());
        return Redirect::route('transports.edit', $transport)->with('status', 'transport-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Transport::destroy($id);
    }
}
