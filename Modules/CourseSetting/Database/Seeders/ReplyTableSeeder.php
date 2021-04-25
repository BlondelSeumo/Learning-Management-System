<?php

namespace Modules\CourseSetting\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\CourseCommentReply;

class ReplyTableSeeder extends Seeder
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
                CourseCommentReply::insert([
                    'course_id' => $key+1,
                    'user_id' => 2,
                    'comment_id' => $i,
                    'status' => 1,
                    'reply' => 'This Course is Very Good',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
        }
    }
}
