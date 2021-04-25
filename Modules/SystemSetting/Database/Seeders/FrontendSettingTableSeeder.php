<?php

namespace Modules\SystemSetting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SystemSetting\Entities\FrontendSetting;


class FrontendSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        FrontendSetting::truncate();
        FrontendSetting::create([
            'section' => 'banner',
            'title' => 'Learn from the best in the world',
            'btn_name' => 'Browse Course',
            'btn_link' => '/allCourses',
            'description' => 'Learn from industry experts who are passionate about teaching.',
        ]);

        FrontendSetting::create([
            'section' => 'cta_part',
            'title' => 'Insights to lead skills to the believer',
            'description' => 'Top instructors from around the world teach millions of students on Infix about peripherals that add functionality to a system.',
        ]);

        FrontendSetting::create([
            'section' => 'course_detail_left',
            'title' => 'Online courses',
            'url' => 'courses',
            'description' => 'Explore a variety of fresh topics',
            'icon' => 'fas fa-book-open'
        ]);

        FrontendSetting::create([
            'section' => 'course_detail_mid',
            'title' => 'Expert teachers',
            'description' => 'Learn from industry experts',
            'url' => 'pages/1/teacher-directory',
            'icon' => 'fas fa-chalkboard-teacher'
        ]);

        FrontendSetting::create([
            'section' => 'course_detail_right',
            'title' => 'Unlimited access',
            'description' => 'Learn on your schedule',
            'url' => 'pages/2/features',
            'icon' => 'fas fa-universal-access'
        ]);

    }
}
