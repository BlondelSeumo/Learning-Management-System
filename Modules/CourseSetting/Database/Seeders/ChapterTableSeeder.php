<?php

namespace Modules\CourseSetting\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\CourseSetting\Entities\Chapter;
use Modules\CourseSetting\Entities\Course;

class ChapterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $course_one = ['Introduction with Accounting','What is Managerial Accounting','Debits & Credits'];
        $course_two = ['Introduction with MBA','Fundamentals of MBA','Advanced MBA'];
        $course_three = ['Introduction with Blendor','How to create Blendor','Creating 3D Blendor'];
        $course_four = ['Introduction with Blendor','Fundamental of Blendor Environment','Creating 3D Environments of Blendor'];
        $course_five = ['Introduction with Adobe UI UX Design','Downloading & Installing Adobe Photoshop','Creating an App Using Adobe'];
        $course_six = ['Introduction with HTML','Introduction with CSS','Creating Our First Webpage'];
        $course_seven = ['Introduction with App Development','Introduction with java & Kotlin','Creating Our First App using Java'];
        $course_eight = ['Introduction with App Development','Introduction with swift & iOS','Creating Our First iOS App'];
        $course_nine = ['Introduction with Pyhton','Fundamental of Pyhton','Creating an web app using python'];
        $course_ten = ['Introduction with Laravel','Fundamental of PHP','Creating an web app using Laravel'];

        foreach($course_one as $key=> $chapter){
            Chapter::insert([
                'course_id' => 1,
                'name' => $chapter,
                'chapter_no' => $key+1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        foreach($course_two as $key=> $chapter){
            Chapter::insert([
                'course_id' => 2,
                'name' => $chapter,
                'chapter_no' => $key+1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        foreach($course_three as $key=> $chapter){
            Chapter::insert([
                'course_id' => 3,
                'name' => $chapter,
                'chapter_no' => $key+1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        foreach($course_four as $key=> $chapter){
            Chapter::insert([
                'course_id' => 4,
                'name' => $chapter,
                'chapter_no' => $key+1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        foreach($course_five as $key=> $chapter){
            Chapter::insert([
                'course_id' => 5,
                'name' => $chapter,
                'chapter_no' => $key+1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        foreach($course_six as $key=> $chapter){
            Chapter::insert([
                'course_id' => 6,
                'name' => $chapter,
                'chapter_no' => $key+1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        foreach($course_seven as $key=> $chapter){
            Chapter::insert([
                'course_id' => 7,
                'name' => $chapter,
                'chapter_no' => $key+1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        foreach($course_eight as $key=> $chapter){
            Chapter::insert([
                'course_id' => 8,
                'name' => $chapter,
                'chapter_no' => $key+1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        foreach($course_nine as $key=> $chapter){
            Chapter::insert([
                'course_id' => 9,
                'name' => $chapter,
                'chapter_no' => $key+1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        foreach($course_ten as $key=> $chapter){
            Chapter::insert([
                'course_id' => 10,
                'name' => $chapter,
                'chapter_no' => $key+1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
