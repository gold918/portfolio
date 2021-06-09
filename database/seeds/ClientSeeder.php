<?php

use Illuminate\Database\Seeder;
use App\Model\Site\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            'name' => 'myob',
            'logo' => 'client-1.png',
            'status' => 1,
        ]);
        Client::create([
            'name' => 'BELIMO',
            'logo' => 'client-2.png',
            'status' => 1,
        ]);
        Client::create([
            'name' => 'Life Groups',
            'logo' => 'client-3.png',
            'status' => 1,
        ]);
        Client::create([
            'name' => 'Lilly',
            'logo' => 'client-4.png',
            'status' => 1,
        ]);
        Client::create([
            'name' => 'citrus',
            'logo' => 'client-5.png',
            'status' => 1,
        ]);
        Client::create([
            'name' => 'Trustly',
            'logo' => 'client-6.png',
            'status' => 1,
        ]);
        Client::create([
            'name' => 'oldendorff',
            'logo' => 'client-7.png',
            'status' => 1,
        ]);
        Client::create([
            'name' => 'grabyo',
            'logo' => 'client-8.png',
            'status' => 1,
        ]);
    }
}
