<?php

namespace App\Http\Controllers\Admin;

use App\Filters\UserFilter;
use App\Http\Requests\UserFilterRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserCategory;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserFilterRequest $request)
    {
        $filter = new UserFilter(User::class);
        $users = $filter->apply($request->validated())->paginate(5);
        $users->load(['userCategory']);
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user, 'userCategories' => UserCategory::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $validatedData = $request->validated();
        $validatedData['is_admin'] ??= false;
        $user->update($validatedData);
        return Redirect::route('users.edit', $user)->with('status', 'user-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return $user->delete();
    }
}
