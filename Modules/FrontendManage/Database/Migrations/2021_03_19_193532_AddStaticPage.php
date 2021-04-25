<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddStaticPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $check1 = \Modules\FrontendManage\Entities\FrontPage::where('slug', '/')->first();
        if (!$check1) {
            DB::table('front_pages')->insert([
                'name' => 'Home',
                'title' => 'Home',
                'sub_title' => 'Home',
                'details' => 'Home Page',
                'slug' => '/',
                'status' => 1,
                'is_static' => 1,
            ]);
        }
        $check2 = \Modules\FrontendManage\Entities\FrontPage::where('slug', '/courses')->first();
        if (!$check2) {
            DB::table('front_pages')->insert([
                'name' => 'Courses',
                'title' => 'Courses',
                'sub_title' => 'Courses',
                'details' => 'Courses',
                'slug' => '/courses',
                'status' => 1,
                'is_static' => 1,
            ]);
        }


        $check3 = \Modules\FrontendManage\Entities\FrontPage::where('slug', '/classes')->first();
        if (!$check3) {
            DB::table('front_pages')->insert([
                'name' => 'Classes',
                'title' => 'Classes',
                'sub_title' => 'Classes',
                'details' => 'Classes',
                'slug' => '/classes',
                'status' => 1,
                'is_static' => 1,
            ]);
        }

        $check4 = \Modules\FrontendManage\Entities\FrontPage::where('slug', '/quizzes')->first();
        if (!$check4) {
            DB::table('front_pages')->insert([
                'name' => 'Quiz',
                'title' => 'Quiz',
                'sub_title' => 'Quiz',
                'details' => 'quiz',
                'slug' => '/quizzes',
                'status' => 1,
                'is_static' => 1,
            ]);
        }

        $check5 = \Modules\FrontendManage\Entities\FrontPage::where('slug', '/instructors')->first();
        if (!$check5) {
            DB::table('front_pages')->insert([
                'name' => 'Instructors',
                'title' => 'Instructors',
                'sub_title' => 'Instructors',
                'details' => 'instructors',
                'slug' => '/instructors',
                'status' => 1,
                'is_static' => 1,
            ]);
        }

        $check6 = \Modules\FrontendManage\Entities\FrontPage::where('slug', '/contact-us')->first();
        if (!$check6) {
            DB::table('front_pages')->insert([
                'name' => 'Contact Us',
                'title' => 'Contact Us',
                'sub_title' => 'Contact Us',
                'details' => 'Contact Us',
                'slug' => '/contact-us',
                'status' => 1,
                'is_static' => 1,
            ]);
        }

        $check7 = \Modules\FrontendManage\Entities\FrontPage::where('slug', 'feature')->first();
        if ($check7) {
            $check7->is_static = 0;
            $check7->save();
        }
        $check8 = \Modules\FrontendManage\Entities\FrontPage::where('slug', 'teacher-directory')->first();
        if ($check8) {
            $check8->is_static = 0;
            $check8->save();
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
