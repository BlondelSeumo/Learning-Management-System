<?php

namespace Modules\ImageGallery\Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\ImageGallery\Entities\ImageGallery;

class SeedImageGalleriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Model::unguard();

        $name = [
            'image 1',
            'image 2',
            'image 3',
            'image 4',
            'image 5',
            'image 6',
            'image 7',
        ];
        $description = [
            'description for image 1',
            'description for image 2',
            'description for image 3',
            'description for image 4',
            'description for image 5',
            'description for image 6',
            'description for image 7',
        ];

        for ($i = 1; $i <= 6; $i++) {
            $s = new ImageGallery();
            $s->title = $name[$i];
            $s->description = $description[$i];
            $s->image = 'public/assets/gallery/' . $i . '.png';
            $s->thumbnail = 'public/assets/gallery/' . $i . '.png';
            $s->save();
        }
    }
}
