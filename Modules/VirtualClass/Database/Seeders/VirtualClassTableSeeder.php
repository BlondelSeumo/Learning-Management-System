<?php

namespace Modules\VirtualClass\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\VirtualClass\Entities\VirtualClass;

class VirtualClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        VirtualClass::truncate();

        VirtualClass::insert([
            'title' => "Online Class for Mastering in Laravel",
            'duration' => 60,
            'category_id' => 1,
            'sub_category_id' => 1,
            'fees' => 30,
            'type' => 0,
            'start_date' => Carbon::now(),
            'time' => Carbon::now(),
            'image' => 'public/frontend/infixlmstheme/img/course/' . '1.' . 'jpg',
            'host' => 'Zoom',
        ]);

        VirtualClass::insert([
            'title' => "Online Class for Mastering in Accounting",
            'duration' => 60,
            'category_id' => 2,
            'sub_category_id' => 2,
            'fees' => 0,
            'type' => 0,
            'start_date' => Carbon::now(),
            'time' => Carbon::now(),
            'image' => 'public/frontend/infixlmstheme/img/course/' . '2.' . 'jpg',
            'host' => 'Zoom',
        ]);


    }
}
