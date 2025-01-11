<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        $users = User::withoutRole('Super-Admin')->get();


        return view('dashboard.users.users', compact('users', 'roles'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::whereNotIn('name', ['Super-Admin'])->get();
        return view('dashboard.users.user-acc', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'string',
            'email' => 'email'
        ]);
        $user->update($request->toArray());
        if ($request['role'] != 'Select Role') {

            $user->syncRoles($request['role']);
        }
        $users = User::withoutRole('Super-Admin')->get();
        ;
        return redirect()->route('users', compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }

    public function Activate(User $user)
    {
        $user->update(['active' => 1]);
        return redirect()->back();
    }
    public function Deactivate(User $user)
    {
        $user->update(['active' => 0]);
        return redirect()->back();
    }
}
