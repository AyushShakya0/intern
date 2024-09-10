<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function assignRole(Request $request, $userId)
    {
        $user = User::find($userId);

        // Validate the request to ensure valid role
        $request->validate([
            'role' => 'required|string|exists:roles,name'
        ]);

        // Assign the role to the user
        $user->assignRole($request->input('role'));

        return response()->json(['message' => 'Role assigned successfully.']);
    }

    public function createRoleAndPermission()
    {
        // Create role
        $creator = Role::create(['name' => 'creator']);
        $editor = Role::create(['name' => 'editor']);
        $deleter = Role::create(['name' => 'deleter']);

        // Create permission
        $view_permission = Permission::create(['name' => 'view posts']);
        $create_permission = Permission::create(['name' => 'create posts']);
        $update_permission = Permission::create(['name' => 'update posts']);
        $delete_permission = Permission::create(['name' => 'delete posts']);

        // Assign permission to role
        $creator->givePermissionTo($view_permission,$create_permission);
        $editor->givePermissionTo($view_permission,$update_permission);
        $deleter->givePermissionTo($view_permission,$delete_permission);
    }
}
