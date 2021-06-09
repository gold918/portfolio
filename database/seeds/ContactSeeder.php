<?php

use Illuminate\Database\Seeder;
use App\Model\Site\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contact = new Contact([
            'title' => 'Location',
            'value' => 'A108 Adam Street, New York, NY 535022',
            'icon' => 'icofont-google-map',
            'status' => 1,
        ]);
        $contact->save();

        $contact = new Contact([
        'title' => 'Email',
        'value' => 'info@example.com',
        'icon' => 'icofont-envelope',
        'status' => 1,
        ]);
        $contact->save();

        $contact = new Contact([
        'title' => 'Call',
        'value' => '+1 5589 55488 55s',
        'icon' => 'icofont-phone',
        'status' => 1,
        ]);
        $contact->save();
    }
}
