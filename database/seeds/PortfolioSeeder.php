<?php

use Illuminate\Database\Seeder;
use App\Model\Site\Filter;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filterApp = Filter::create([
            'name' => 'app',
            'alias' => 'app',
            'status' => 1,
        ]);
        $filterCard = Filter::create([
            'name' => 'card',
            'alias' => 'card',
            'status' => 1,
        ]);
        $filterWeb = Filter::create([
            'name' => 'web',
            'alias' => 'web',
            'status' => 1,
        ]);

        $filterApp->portfolio()->create([
            'name' => 'App 1',
            'alias' => 'app-1',
            'image' => 'portfolio-1.jpg',
            'text' => ' Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia.
                        Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium
                        nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.',
            'status' => 1,
        ]);
        $filterWeb->portfolio()->create([
            'name' => 'Web 3',
            'alias' => 'web-3',
            'image' => 'portfolio-2.jpg',
            'text' => ' Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia.
                        Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium
                        nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.',
            'status' => 1,
        ]);
        $filterApp->portfolio()->create([
            'name' => 'App 2',
            'alias' => 'app-2',
            'image' => 'portfolio-3.jpg',
            'text' => ' Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia.
                        Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium
                        nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.',
            'status' => 1,
        ]);
        $filterCard->portfolio()->create([
            'name' => 'Card 2',
            'alias' => 'card-2',
            'image' => 'portfolio-4.jpg',
            'text' => ' Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia.
                        Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium
                        nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.',
            'status' => 1,
        ]);
        $filterWeb->portfolio()->create([
            'name' => 'Web 2',
            'alias' => 'web-2',
            'image' => 'portfolio-5.jpg',
            'text' => ' Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia.
                        Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium
                        nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.',
            'status' => 1,
        ]);
        $filterApp->portfolio()->create([
            'name' => 'App 3',
            'alias' => 'app-3',
            'image' => 'portfolio-6.jpg',
            'text' => ' Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia.
                        Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium
                        nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.',
            'status' => 1,
        ]);
        $filterCard->portfolio()->create([
            'name' => 'Card 1',
            'alias' => 'card-1',
            'image' => 'portfolio-7.jpg',
            'text' => ' Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia.
                        Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium
                        nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.',
            'status' => 1,
        ]);
        $filterCard->portfolio()->create([
            'name' => 'Card 3',
            'alias' => 'card-3',
            'image' => 'portfolio-8.jpg',
            'text' => ' Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia.
                        Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium
                        nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.',
            'status' => 1,
        ]);
        $filterWeb->portfolio()->create([
            'name' => 'Web 3',
            'alias' => 'web-3',
            'image' => 'portfolio-9.jpg',
            'text' => ' Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia.
                        Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium
                        nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.',
            'status' => 1,
        ]);
    }
}
