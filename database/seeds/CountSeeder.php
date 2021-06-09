<?php

use Illuminate\Database\Seeder;
use App\Model\Site\Count;

class CountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $counts = Count::create([
            'title' => 'Voluptatem dignissimos provident quasi',
            'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                        ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit',
            'image' => 'counts-img.jpg',
            'status' => 1,
        ]);

        $counts->countItems()->createMany([
            [
                'main_word' => 'Happy Clients',
                'text' => 'consequuntur voluptas nostrum aliquid ipsam architecto ut.',
                'icon' => 'icofont-simple-smile',
                'number' => 65,
                'status' => 1,
            ],
            [
                'main_word' => 'Projects',
                'text' => 'adipisci atque cum quia aspernatur totam laudantium et quia dere tan',
                'icon' => 'icofont-document-folder',
                'number' => 85,
                'status' => 1,
            ],
            [
                'main_word' => 'Years of experience',
                'text' => 'aut commodi quaerat modi aliquam nam ducimus aut voluptate non vel',
                'icon' => 'icofont-clock-time',
                'number' => 12,
                'status' => 1,
            ],
            [
                'main_word' => 'Awards',
                'text' => 'rerum asperiores dolor alias quo reprehenderit eum et nemo pad der',
                'icon' => 'icofont-award',
                'number' => 15,
                'status' => 1,
            ],
        ]);
    }
}
