<?php

namespace Modules\Quiz\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Quiz\Entities\OnlineQuiz;

class OnlineQuizTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        OnlineQuiz::insert([
            'title' => '1st term Quiz',
            'percentage' => 50,
            'status' => 1,
            'instruction' => 'get 50% mark to enroll',
            'category_id' => 1,
            'sub_category_id' => 1,
        ]);

        OnlineQuiz::insert([
            'title' => 'Mid term Quiz',
            'percentage' => 50,
            'status' => 1,
            'instruction' => 'get 50% mark to enroll',
            'category_id' => 2,
            'sub_category_id' => 2,
        ]);
        OnlineQuiz::insert([
            'title' => 'Final Quiz',
            'percentage' => 90,
            'status' => 1,
            'instruction' => 'get 90% mark to enroll',
            'category_id' => 3,
            'sub_category_id' => 3,
        ]);
    }
}
