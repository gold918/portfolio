<?php

use Illuminate\Database\Seeder;
use App\Model\Site\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team = Team::create([
            'name' => 'Walter White',
            'position' => 'Chief Executive Officer',
            'photo' => 'team-1.jpg',
            'status' => 1,
        ]);

        $team->teamSocials()->createMany([
            [
                'name' => 'twitter',
                'icon' => 'icofont-twitter',
                'link' => 'https://twitter.com/',
                'status' => 1,
            ],
            [
                'name' => 'facebook',
                'icon' => 'icofont-facebook',
                'link' => 'https://www.facebook.com/',
                'status' => 1,
            ],
            [
                'name' => 'instagram',
                'icon' => 'icofont-instagram',
                'link' => 'https://www.instagram.com/',
                'status' => 1,
            ],
            [
                'name' => 'linkedin',
                'icon' => 'icofont-linkedin',
                'link' => 'https://www.linkedin.com/',
                'status' => 1,
            ]
        ]);

        $team = Team::create([
            'name' => 'Sarah Jhonson',
            'position' => 'Product Manager',
            'photo' => 'team-2.jpg',
            'status' => 1,
        ]);

        $team->teamSocials()->createMany([
            [
                'name' => 'twitter',
                'icon' => 'icofont-twitter',
                'link' => 'https://twitter.com/',
                'status' => 1,
            ],
            [
                'name' => 'facebook',
                'icon' => 'icofont-facebook',
                'link' => 'https://www.facebook.com/',
                'status' => 1,
            ],
            [
                'name' => 'instagram',
                'icon' => 'icofont-instagram',
                'link' => 'https://www.instagram.com/',
                'status' => 1,
            ],
            [
                'name' => 'linkedin',
                'icon' => 'icofont-linkedin',
                'link' => 'https://www.linkedin.com/',
                'status' => 1,
            ]
        ]);

        $team = Team::create([
            'name' => 'William Anderson',
            'position' => 'CTO',
            'photo' => 'team-3.jpg',
            'status' => 1,
        ]);

        $team->teamSocials()->createMany([
            [
                'name' => 'twitter',
                'icon' => 'icofont-twitter',
                'link' => 'https://twitter.com/',
                'status' => 1,
            ],
            [
                'name' => 'facebook',
                'icon' => 'icofont-facebook',
                'link' => 'https://www.facebook.com/',
                'status' => 1,
            ],
            [
                'name' => 'instagram',
                'icon' => 'icofont-instagram',
                'link' => 'https://www.instagram.com/',
                'status' => 1,
            ],
            [
                'name' => 'linkedin',
                'icon' => 'icofont-linkedin',
                'link' => 'https://www.linkedin.com/',
                'status' => 1,
            ]
        ]);

        $team = Team::create([
            'name' => 'Amanda Jepson',
            'position' => 'Accountant',
            'photo' => 'team-4.jpg',
            'status' => 1,
        ]);

        $team->teamSocials()->createMany([
            [
                'name' => 'twitter',
                'icon' => 'icofont-twitter',
                'link' => 'https://twitter.com/',
                'status' => 1,
            ],
            [
                'name' => 'facebook',
                'icon' => 'icofont-facebook',
                'link' => 'https://www.facebook.com/',
                'status' => 1,
            ],
            [
                'name' => 'instagram',
                'icon' => 'icofont-instagram',
                'link' => 'https://www.instagram.com/',
                'status' => 1,
            ],
            [
                'name' => 'linkedin',
                'icon' => 'icofont-linkedin',
                'link' => 'https://www.linkedin.com/',
                'status' => 1,
            ]
        ]);
    }
}
