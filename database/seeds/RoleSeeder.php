<?php

use Illuminate\Database\Seeder;
use App\User\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role([
            'title' => 'guest',
        ]);
        $role->save();

        $role = new Role([
            'title' => 'moderator',
        ]);
        $role->save();

        $role = new Role([
            'title' => 'administrator',
        ]);
        $role->save();
    }
}
