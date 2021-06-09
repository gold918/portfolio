<?php

use Illuminate\Database\Seeder;
use App\Model\Site\HeroMain;

class HeroMainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hero = HeroMain::create([
            'title' => 'Powerful Digital Solutions With Gp.',
            'alias' => 'hero',
            'text' => 'We are team of talented digital marketers',
            'background_image' => 'hero-bg.jpg',
            'status' => 1,
        ]);

        $hero->heroIconBoxes()->createMany([
            [
                'title' => 'Lorem Ipsum',
                'alias' => 'lorem-ipsum',
                'icon' => 'ri-store-line',
                'status' => 1,
            ],
            [
                'title' => 'Dolor Sitema',
                'alias' => 'dolor-sitema',
                'icon' => 'ri-bar-chart-box-line',
                'status' => 1,
            ],
            [
                'title' => 'Sedare Perspiciatis',
                'alias' => 'sedare-perspiciatis',
                'icon' => 'ri-calendar-todo-line',
                'status' => 1,
            ],
            [
                'title' => 'Magni Dolores',
                'alias' => 'magni-dolores',
                'icon' => 'ri-paint-brush-line',
                'status' => 1,
            ],
            [
                'title' => 'Nemos Enimade',
                'alias' => 'nemos-enimade',
                'icon' => 'ri-database-2-line',
                'status' => 1,
            ]
       ]);
    }
}
