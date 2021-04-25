<?php

namespace Modules\CourseSetting\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\CourseSetting\Entities\Category;
use Faker\Generator as Faker;

class CategorySeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Category::insert([
            'name' => 'Business',
            'status' => '1',
            'show_home' => '1',
            'title' => 'Voluptas eos placeat',
            'description' => 'Laboris Nam laborum voluptatibus dolor aspernatur laboriosam commodo in voluptatem Temporibus eum',
            'position_order' => 2,
            'image' => 'public/demo/category/image/' . '1.' . 'png',
            'thumbnail' => 'public/demo/category/thumb/' . '1.' . 'png',
            'url' => 'https://youtu.be/bG9eMa_025c',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        Category::insert([
            'name' => '3D Modeling',
            'status' => '1',
            'show_home' => '1',
            'title' => 'Voluptas eos placeat',
            'description' => 'Laboris Nam laborum voluptatibus dolor aspernatur laboriosam commodo in voluptatem Temporibus eum',
            'position_order' => 2,
            'image' => 'public/demo/category/image/' . '2.' . 'png',
            'thumbnail' => 'public/demo/category/thumb/' . '2.' . 'png',
            'url' => 'https://youtu.be/bG9eMa_025c',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        Category::insert([
            'name' => 'UI UX Design',
            'status' => '1',
            'show_home' => '1',
            'title' => 'Voluptas eos placeat',
            'description' => 'Laboris Nam laborum voluptatibus dolor aspernatur laboriosam commodo in voluptatem Temporibus eum',
            'position_order' => 3,
            'image' => 'public/demo/category/image/' . '3.' . 'png',
            'thumbnail' => 'public/demo/category/thumb/' . '3.' . 'png',
            'url' => 'https://youtu.be/bG9eMa_025c',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        Category::insert([
            'name' => 'Mobile Development',
            'status' => '1',
            'show_home' => '1',
            'title' => 'Voluptas eos placeat',
            'description' => 'Laboris Nam laborum voluptatibus dolor aspernatur laboriosam commodo in voluptatem Temporibus eum',
            'position_order' => 4,
            'image' => 'public/demo/category/image/' . '4.' . 'png',
            'thumbnail' => 'public/demo/category/thumb/' . '4.' . 'png',
            'url' => 'https://youtu.be/bG9eMa_025c',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        Category::insert([
            'name' => 'Software Development',
            'status' => '1',
            'show_home' => '1',
            'title' => 'Voluptas eos placeat',
            'description' => 'Laboris Nam laborum voluptatibus dolor aspernatur laboriosam commodo in voluptatem Temporibus eum',
            'position_order' => 5,
            'image' => 'public/demo/category/image/' . '5.' . 'png',
            'thumbnail' => 'public/demo/category/thumb/' . '5.' . 'png',
            'url' => 'https://youtu.be/bG9eMa_025c',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
    }
}
