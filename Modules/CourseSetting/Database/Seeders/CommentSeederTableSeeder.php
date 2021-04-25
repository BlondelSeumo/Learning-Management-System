<?php

namespace Modules\CourseSetting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\CourseSetting\Entities\CourseComment;

class CommentSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $faker = Faker::create();
        for($i=1; $i<=6; $i++){
        $comment = new CourseComment();
        $comment->user_id = 3;
        $comment->instructor_id	 = 2;
        $comment->course_id = $i;
        $comment->status = 3;
        $comment->comment = $faker->name;
        $comment->save();
    }
}
}