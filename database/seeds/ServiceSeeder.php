<?php

use Illuminate\Database\Seeder;
use App\Model\Site\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'title' => 'Lorem Ipsum',
            'alias' => 'lorem-ipsum',
            'text' => 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi',
            'icon' => 'bxl-dribbble',
            'status' => 1,
        ]);
        Service::create([
            'title' => 'Sed ut perspiciatis',
            'alias' => 'sed-ut-perspiciatis',
            'text' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore',
            'icon' => 'bx-file',
            'status' => 1,
        ]);
        Service::create([
            'title' => 'Magni Dolores',
            'alias' => 'magni-dolores',
            'text' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia',
            'icon' => 'bx-tachometer',
            'status' => 1,
        ]);
        Service::create([
            'title' => 'Nemo Enim',
            'alias' => 'nemo-enim',
            'text' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis',
            'icon' => 'bx-world',
            'status' => 1,
        ]);
        Service::create([
            'title' => 'dele cardo',
            'alias' => 'dele-cardo',
            'text' => 'Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur',
            'icon' => 'bx-slideshow',
            'status' => 1,
        ]);
        Service::create([
            'title' => 'Divera don',
            'alias' => 'divera-don',
            'text' => 'Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur',
            'icon' => 'bx-arch',
            'status' => 1,
        ]);
    }
}
