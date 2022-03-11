<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for admin only
        $user = new User();
        $user->name = "School_Admin";
        $user->user_type = 0;
        $user->is_first_time_login = false;
        $user->email = "admin@admin.com";
        $user->password = Hash::make("123");
        $user->save();
    }
}
