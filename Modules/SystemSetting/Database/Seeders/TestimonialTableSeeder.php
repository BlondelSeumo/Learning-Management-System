<?php

namespace Modules\SystemSetting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SystemSetting\Entities\Testimonial;

class TestimonialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Testimonial::create([
            'body' => "Working in conjunction with humanitarian aid agencies, we have supported programmes to help alleviate human suffering through.",
            'author' => "Micky Mouse",
            'profession' => "Photographer",
            'star' => "4",
            'image' => 'public/demo/testimonial/image/1.png',
            'status' => 1,
        ]);

        Testimonial::create([
            'body' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'author' => "Steve Smith",
            'profession' => "Cricketer",
            'star' => "5",
            'image' => 'public/demo/testimonial/image/2.png',
            'status' => 1,
        ]);

        Testimonial::create([
            'body' => "Working in conjunction with humanitarian aid agencies, we have supported programmes to help alleviate human suffering through.",
            'author' => "Mickel Clark",
            'profession' => "Cricketer",
            'star' => "5",
            'image' => 'public/demo/testimonial/image/3.png',
            'status' => 1,
        ]);

        Testimonial::create([
            'body' => "Kissmetrics customer describes how the software helped him achieve his goals.
             Notice how he highlights different features that Kissmetrics offers and how they directly impacted his business",
            'author' => "Spence Monn",
            'profession' => "LucidChart",
            'image' => 'public/demo/testimonial/image/4.png',
            'status' => 1,
        ]);
    }

}
