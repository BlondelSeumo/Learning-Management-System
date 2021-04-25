<?php

namespace Modules\CourseSetting\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\CourseReveiw;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $courses = Course::all();

        // for ($i =1; $i <= 1 ; $i++){
        //     foreach ($courses as $key => $course)
        //         CourseReveiw::insert([
        //             'course_id' => $key+1,
        //             'user_id' => 3,
        //             'comment' => 'I liked this course very much. It is very inforamtive and easy to learn .',
        //             'star' => $key%2 == 0 ? 4 : 5,
        //             'status' => 1,
        //             'created_at' => Carbon::now(),
        //             'updated_at' => Carbon::now(),
        //         ]);
        // }
    }
}
