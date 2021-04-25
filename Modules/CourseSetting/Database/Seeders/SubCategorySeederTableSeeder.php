<?php

namespace Modules\CourseSetting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\CourseSetting\Entities\SubCategory;

class SubCategorySeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        SubCategory::insert([
            'category_id' => 1,
            'name' => 'Accounting',
            'status' => '1',
            'show_home'=>'1',
            'position_order'=> 1,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        SubCategory::insert([
            'category_id' => 1,
            'name' => 'MBA',
            'status' => '1',
            'show_home'=>'1',
            'position_order'=> 2,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        SubCategory::insert([
            'category_id' => 2,
            'name' => 'Blender Creator',
            'status' => '1',
            'show_home'=>'1',
            'position_order'=> 3,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        SubCategory::insert([
            'category_id' => 2,
            'name' => '3D environments',
            'status' => '1',
            'show_home'=>'1',
            'position_order'=> 4,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        SubCategory::insert([
            'category_id' => 3,
            'name' => 'Adobe XD',
            'status' => '1',
            'show_home'=>'1',
            'position_order'=> 5,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        SubCategory::insert([
            'category_id' => 3,
            'name' => 'UI Design',
            'status' => '1',
            'show_home'=>'1',
            'position_order'=> 6,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        SubCategory::insert([
            'category_id' => 4,
            'name' => 'App Development',
            'status' => '1',
            'show_home'=>'1',
            'position_order'=> 7,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        SubCategory::insert([
            'category_id' => 4,
            'name' => 'iOS Development',
            'status' => '1',
            'show_home'=>'1',
            'position_order'=> 8,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        SubCategory::insert([
            'category_id' => 5,
            'name' => 'Python',
            'status' => '1',
            'show_home'=>'1',
            'position_order'=> 9,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        SubCategory::insert([
            'category_id' => 5,
            'name' => 'Laravel',
            'status' => '1',
            'show_home'=>'1',
            'position_order'=> 10,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
    }
}
