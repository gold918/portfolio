<?php

use Illuminate\Database\Seeder;
use App\Model\Site\About;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $about = About::create([
            'title' => 'Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.',
            'subtitle' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'text' => 'Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                        in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident',
            'image' => 'about.jpg',
            'status' => 1,
        ]);

        $about->aboutItems()->createMany([
            [
                'list_item' => 'Ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'status' => 1,
            ],
            [
                'list_item' => 'Duis aute irure dolor in reprehenderit in voluptate velit.',
                'status' => 1,
            ],
            [
                'list_item' => 'Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta
                                storacalaperda mastiro dolore eu fugiat nulla pariatur.',
                'status' => 1,
            ],
        ]);
    }
}
