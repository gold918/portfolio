<?php

use Illuminate\Database\Seeder;
use App\Model\Site\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testimonials = Testimonial::create([
            'background_image' => 'testimonials-bg.jpg',
            'status' => 1,
        ]);

        $testimonials->testimonialItems()->createMany([
            [
                'name' => 'Saul Goodman',
                'photo' => 'testimonials-1.jpg',
                'position' => 'Ceo &amp; Founder',
                'review' => 'Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam,
                            ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.',
                'status' => 1,
            ],
            [
                'name' => 'Sara Wilsson',
                'photo' => 'testimonials-2.jpg',
                'position' => 'Designer',
                'review' => 'Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum
                            velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.',
                'status' => 1,
            ],
            [
                'name' => 'Jena Karlis',
                'photo' => 'testimonials-3.jpg',
                'position' => 'Store Owner',
                'review' => 'Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis
                            minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.',
                'status' => 1,
            ],
            [
                'name' => 'Matt Brandon',
                'photo' => 'testimonials-4.jpg',
                'position' => 'Freelancer',
                'review' => 'Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat
                            minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.',
                'status' => 1,
            ],
            [
                'name' => 'John Larson',
                'photo' => 'testimonials-5.jpg',
                'position' => 'Entrepreneur',
                'review' => 'Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam
                            enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.',
                'status' => 1,
            ],
        ]);
    }
}
