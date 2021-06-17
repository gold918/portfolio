<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(HeroMainSeeder::class);
        $this->call(AboutSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(ActionSeeder::class);
        $this->call(CountSeeder::class);
        $this->call(TestimonialSeeder::class);
        $this->call(PortfolioSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(MapSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(SiteSocialSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RuleSeeder::class);
        $this->call(UserSeeder::class);
    }
}
