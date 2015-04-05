<?php

use Illuminate\Database\Seeder;

use App\Models\Admin\User;
use App\Models\Admin\Role;


class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $role = Role::firstOrCreate(['name' => 'admin']);

        $user = User::where('email', 'fruiz@gmail.com')->first();
        if (!$user) {
            $user = User::Create([
                'name' => 'Fernando RUIZ CASAS (Admin)',
                'email' => 'fruiz@gmail.com',
                'password' => bcrypt('password')
            ]);
        }

        $role->users()->sync([$user->id]);
    }

}