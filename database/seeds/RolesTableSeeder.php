<?php

use Illuminate\Database\Seeder;


use App\Models\Admin\Role;


class RolesTableSeeder extends Seeder {

    public function run()
    {
        Role::firstOrCreate(
            ['name' => 'admin']
        );

        Role::firstOrCreate(
            ['name' => 'owner']
        );

        Role::firstOrCreate(
            ['name' => 'reviewer']
        );

        Role::firstOrCreate(
            ['name' => 'approver']
        );

        Role::firstOrCreate(
            ['name' => 'signer']
        );
    }

}