<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt(11111111),
        ]);
        $admin->role()->associate(3);
        $admin->save();
    }
}
