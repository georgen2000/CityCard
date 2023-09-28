<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCategoryRequest;
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
        return view('admin.user_categories.index', ['user_categories'=> UserCategory::paginate(5)]);
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
    public function store(UserCategoryRequest $request)
    {
        $user_category = new UserCategory($request->validated());
        $user_category->save();
        return Redirect::route('user_categories.create')->with('status', 'user-category-created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserCategory $userCategory)
    {
        return view('admin.user_categories.edit', ['user_category'=>$userCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserCategoryRequest $request, UserCategory $userCategory)
    {
        $userCategory->update($request->all());
        return Redirect::route('user_categories.edit', $userCategory)->with('status', 'user-category-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return UserCategory::destroy($id);
    }
}
