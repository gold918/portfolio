<?php

use Illuminate\Database\Seeder;
use App\Model\Site\SiteSocial;

class SiteSocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $social = new SiteSocial([
            'name' => 'twitter',
            'icon' => 'bxl-twitter',
            'link' => 'https://twitter.com/',
            'status' => 1,
        ]);
        $social->save();

        $social = new SiteSocial([
            'name' => 'facebook',
            'icon' => 'bxl-facebook',
            'link' => 'https://www.facebook.com/',
            'status' => 1,
        ]);
        $social->save();

        $social = new SiteSocial([
            'name' => 'instagram',
            'icon' => 'bxl-instagram',
            'link' => 'https://www.instagram.com/',
            'status' => 1,
        ]);
        $social->save();

        $social = new SiteSocial([
            'name' => 'skype',
            'icon' => 'bxl-skype',
            'link' => 'https://www.skype.com/',
            'status' => 1,
        ]);
        $social->save();

        $social = new SiteSocial([
            'name' => 'linkedin',
            'icon' => 'bxl-linkedin',
            'link' => 'https://www.linkedin.com/',
            'status' => 1,
        ]);
        $social->save();
    }
}
