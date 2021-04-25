<?php

namespace Modules\CourseSetting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\CourseSetting\Database\Seeders\PackageSeederTableSeeder;
use Modules\CourseSetting\Database\Seeders\CategorySeederTableSeeder;
use Modules\CourseSetting\Database\Seeders\SubCategorySeederTableSeeder;


class CourseSettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CategorySeederTableSeeder::class);
        $this->call(SubCategorySeederTableSeeder::class);
        $this->call(CourseSeederTableSeeder::class);
        $this->call(EnrolledTableSeeder::class);
        $this->call(ChapterTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(ExerciseTableSeeder::class);
        $this->call(LessonTableSeeder::class);
        $this->call(NotificationTableSeeder::class);
        $this->call(ReplyTableSeeder::class);
        $this->call(ReviewTableSeeder::class);

    }
}
