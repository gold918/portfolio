<?php

use Illuminate\Database\Seeder;
use App\User\Role;
use App\User\Rule;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
/*        $moderator = Role::find(2);
        $admin = Role::find(3);*/

        $rule = new Rule ([
            'title' => 'section-dashboard'
        ]);
        $rule->save();
        $rule->roles()->attach([2, 3]);
        $rule->save();

        $rule = new Rule;
        $rule->title = 'section-index';
        $rule->save();
        $rule->roles()->attach([2, 3]);
        $rule->save();

        $rule = new Rule;
        $rule->title = 'section-create';
        $rule->save();
        $rule->roles()->attach([2, 3]);
        $rule->save();

        $rule = new Rule;
        $rule->title = 'section-store';
        $rule->save();
        $rule->roles()->attach([2, 3]);
        $rule->save();

        $rule = new Rule;
        $rule->title = 'section-edit';
        $rule->save();
        $rule->roles()->attach([2, 3]);
        $rule->save();

        $rule = new Rule;
        $rule->title = 'section-update';
        $rule->save();
        $rule->roles()->attach([2, 3]);
        $rule->save();

        $rule = new Rule;
        $rule->title = 'section-delete';
        $rule->save();
        $rule->roles()->attach([2, 3]);
        $rule->save();

        $rule = new Rule;
        $rule->title = 'user-dashboard';
        $rule->save();
        $rule->roles()->attach(3);
        $rule->save();

        $rule = new Rule;
        $rule->title = 'user-index';
        $rule->save();
        $rule->roles()->attach(3);
        $rule->save();

        $rule = new Rule;
        $rule->title = 'user-create';
        $rule->save();
        $rule->roles()->attach(3);
        $rule->save();

        $rule = new Rule;
        $rule->title = 'user-store';
        $rule->save();
        $rule->roles()->attach(3);
        $rule->save();

        $rule = new Rule;
        $rule->title = 'user-edit';
        $rule->save();
        $rule->roles()->attach(3);
        $rule->save();

        $rule = new Rule;
        $rule->title = 'user-update';
        $rule->save();
        $rule->roles()->attach(3);
        $rule->save();

        $rule = new Rule;
        $rule->title = 'user-delete';
        $rule->save();
        $rule->roles()->attach(3);
        $rule->save();
    }
}
