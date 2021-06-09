<?php

use Illuminate\Database\Seeder;
use App\Model\Site\Feature;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $features = Feature::create([
            'image' => 'features.jpg',
            'status' => 1,
        ]);

        $features->featureItems()->createMany([
            [
                'title' => 'Est labore ad',
                'text' => 'Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip',
                'icon' => 'bx-receipt',
                'status' => 1,
            ],
            [
                'title' => 'Harum esse qui',
                'text' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt',
                'icon' => 'bx-cube-alt',
                'status' => 1,
            ],
            [
                'title' => 'Aut occaecati',
                'text' => 'Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere',
                'icon' => 'bx-images',
                'status' => 1,
            ],
            [
                'title' => 'Beatae veritatis',
                'text' => 'Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta',
                'icon' => 'bx-shield',
                'status' => 1,
            ],
        ]);
    }
}
