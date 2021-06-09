<?php

use Illuminate\Database\Seeder;
use App\Model\Site\Action;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Action::create([
            'title' => 'Call To Action',
            'text' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'button_text' => 'Call To Action',
            'link' => 'call-to-action',
            'background_image' => 'cta-bg.jpg',
            'status' => 1,
        ]);
    }
}
