<?php

namespace Modules\CourseSetting\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\CourseSetting\Entities\Chapter;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\CourseExercise;

class ExerciseTableSeeder extends Seeder
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

        for ($i = 1; $i <= 3; $i++) {
            foreach ($courses as $key => $course)
                if ($course->type == 1) {
                    CourseExercise::insert([
                        'course_id' => $key + 1,
                        'fileName' => 'Exercise File-' . $i,
                        'file' => 'public/demo/file/1.txt',
                        'lock' => $i == 1 ? 0 : 1,
                        'status' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
        }
    }
}
