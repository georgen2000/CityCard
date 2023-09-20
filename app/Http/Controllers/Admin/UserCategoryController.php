<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserCategory;
use Illuminate\Support\Facades\Redirect;

class UserCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_categories = UserCategory::all();
        return view('admin.user_categories.index', ['user_categories'=> $user_categories? $user_categories->toArray() : []]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);
        $user_category = new UserCategory($validatedData);
        $user_category->save();
        return Redirect::route('user_categories.create')->with('status', 'user_category-created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user_category = UserCategory::find($id);
        if (!$user_category) return Redirect::route('admin.user_categories.index');
        return view('admin.user_categories.edit', ['user_category'=>$user_category->toArray()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);
        UserCategory::find($id)->update($validatedData);
        return Redirect::route('user_categories.edit', ['user_category'=>$id] )->with('status', 'user_category-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return UserCategory::destroy($id);
    }
}
