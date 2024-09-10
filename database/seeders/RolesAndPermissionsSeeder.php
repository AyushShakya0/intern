<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create permissions
        $viewPostsPermission = Permission::create(['name' => 'view posts']);
        $createPostsPermission = Permission::create(['name' => 'create posts']);
        $updatePostsPermission = Permission::create(['name' => 'update posts']);
        $deletePostsPermission = Permission::create(['name' => 'delete posts']);

        // Create roles and assign corresponding permissions
        $reader = Role::create(['name' => 'reader']);
        $reader->givePermissionTo($viewPostsPermission);

        $creator = Role::create(['name' => 'creator']);
        $creator->givePermissionTo($viewPostsPermission);
        $creator->givePermissionTo($createPostsPermission);

        $editor = Role::create(['name' => 'editor']);
        $editor->givePermissionTo($viewPostsPermission);
        $editor->givePermissionTo($updatePostsPermission);

        $deleter = Role::create(['name' => 'deleter']);
        $deleter->givePermissionTo($viewPostsPermission);
        $deleter->givePermissionTo($deletePostsPermission);
    }
}
