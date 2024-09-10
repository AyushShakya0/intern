<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssignRolesToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::find(1);
        $user->assignRole('creator');

        $user2 = User::find(2);
        $user2->assignRole('editor');

        $user2 = User::find(3);
        $user2->assignRole('deleter');
    }
}
