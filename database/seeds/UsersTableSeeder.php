<?php

use Illuminate\Database\Seeder;

use App\Models\Admin\User;


class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $user = User::where('email', 'admin@admin.com')->first();
        if (!$user) {
            $user = User::Create([
                'name' => 'administrator',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
                'is_admin' => true,
            ]);
        }
    }

}