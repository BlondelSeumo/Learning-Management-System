<?php

namespace Modules\CourseSetting\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\Notification;

class NotificationTableSeeder extends Seeder
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

        for ($i =1; $i <= 3 ; $i++) {
            foreach ($courses as $key => $course) {
                if ($i == 1) {
                    Notification::insert([
                        'course_id' => $key + 1,
                        'user_id' => 2,
                        'author_id' => 3,
                        'course_comment_id' => $i,
                        'status' => 0,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
                if ($i == 2) {
                    Notification::insert([
                        'course_id' => $key + 1,
                        'user_id' => 2,
                        'author_id' => 3,
                        'course_review_id' => $i,
                        'status' => 0,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
                if ($i == 3) {
                    Notification::insert([
                        'course_id' => $key + 1,
                        'user_id' => 2,
                        'author_id' => 3,
                        'course_enrolled_id' => $i,
                        'status' => 0,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }
        }
    }
}
