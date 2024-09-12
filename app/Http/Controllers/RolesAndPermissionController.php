<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $users = User::all();
        return view('RolesPermission.RolesAndPermissions', compact('roles', 'permissions', 'users'));
    }


    // Method to handle role assignment to users
    public function assignRole(Request $request)
    {

        // dd($request->all());
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);
        // dd($validated['role_id']);
        // Get the user and the role
        $user = User::findOrFail($validated['user_id']);
        $role = Role::findOrFail($validated['role_id']);

        // Assign the role to the user
        $user->assignRole($role);

        return redirect()->back()->with('success', 'Role assigned to user successfully!');
    }

    public function assignPermission(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|array', // Ensures it's an array
            'permission_id.*' => 'exists:permissions,id', // Validates each permission id
        ]);

        // Find the role
        $role = Role::findOrFail($validated['role_id']);

        // Retrieve permissions by their IDs and convert to names
        $permissions = Permission::whereIn('id', $validated['permission_id'])->pluck('name')->toArray();

        // Add each new permission without removing old ones
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }

        return redirect()->back()->with('success', 'Permissions assigned to role successfully!');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
