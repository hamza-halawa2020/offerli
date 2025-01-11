<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::whereNotIn('name', ['Super-Admin'])->get();
        return view('dashboard.roles.roles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.roles.create-role');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Role::create(['name' => $request['name']]);
        $roles = Role::whereNotIn('name', ['Super-Admin'])->get();

        return redirect()->route('roles.index', compact('roles'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $permissions = Permission::all();
        return view('dashboard.roles.permissions', ['role' => $role, 'permissions' => $permissions]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->permissions()->detach();
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            if ($request[$permission->id] == "on") {
                $role->givePermissionTo($permission);
            }
        }
        $roles = Role::whereNotIn('name', ['Super-Admin'])->get();
        return redirect()->route('roles.index', compact('roles'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back();
    }
}
