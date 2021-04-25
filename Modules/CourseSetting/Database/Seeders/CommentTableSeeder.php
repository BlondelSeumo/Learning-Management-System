<?php

namespace Modules\CourseSetting\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\CourseComment;

class CommentTableSeeder extends Seeder
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

        for ($i =1; $i <= 3 ; $i++){
            foreach ($courses as $key => $course)
                CourseComment::insert([
                    'course_id' => $key+1,
                    'user_id' => 3,
                    'instructor_id' => 2,
                    'status' => 1,
                    'comment' => 'I want to know all the details about this Course',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
        }
    }
}
