<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Modules\FrontendManage\Entities\FrontPage;

class AddStaticPageWithMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $check1 = FrontPage::where('slug', '/about-us')->first();
        if (!$check1) {
            DB::table('front_pages')->insert([
                'name' => 'About Us',
                'title' => 'About Us',
                'sub_title' => 'About Us',
                'details' => 'About Us',
                'slug' => '/about-us',
                'status' => 1,
                'is_static' => 1,
            ]);
        }


        $check2 = FrontPage::where('slug', '/become-instructor')->first();
        if (!$check2) {
            DB::table('front_pages')->insert([
                'name' => 'Become Instructor',
                'title' => 'Become Instructor',
                'sub_title' => 'Become Instructor',
                'details' => 'Become Instructor',
                'slug' => '/become-instructor',
                'status' => 1,
                'is_static' => 1,
            ]);
        }


        $check3 = FrontPage::where('slug', '/blogs')->first();
        if (!$check3) {
            DB::table('front_pages')->insert([
                'name' => 'Blogs',
                'title' => 'Blogs',
                'sub_title' => 'Blogs',
                'details' => 'Blogs',
                'slug' => '/blogs',
                'status' => 1,
                'is_static' => 1,
            ]);
        }

        $check4 = FrontPage::where('slug', '/privacy')->first();
        if (!$check4) {
            DB::table('front_pages')->insert([
                'name' => 'Privacy',
                'title' => 'Privacy',
                'sub_title' => 'Privacy',
                'details' => 'Privacy',
                'slug' => '/privacy',
                'status' => 1,
                'is_static' => 1,
            ]);
        }


        $check5 = FrontPage::where('slug', '/student-dashboard')->first();
        if (!$check5) {
            DB::table('front_pages')->insert([
                'name' => 'Student Dashboard',
                'title' => 'Student Dashboard',
                'sub_title' => 'Student Dashboard',
                'details' => 'Student Dashboard',
                'slug' => '/student-dashboard',
                'status' => 1,
                'is_static' => 1,
            ]);
        }


        $check6 = FrontPage::where('slug', '/my-courses')->first();
        if (!$check6) {
            DB::table('front_pages')->insert([
                'name' => 'My Courses',
                'title' => 'My Courses',
                'sub_title' => 'My Courses',
                'details' => 'My Courses',
                'slug' => '/my-courses',
                'status' => 1,
                'is_static' => 1,
            ]);
        }


        $check6 = FrontPage::where('slug', '/my-quizzes')->first();
        if (!$check6) {
            DB::table('front_pages')->insert([
                'name' => 'My Quizzes',
                'title' => 'My Quizzes',
                'sub_title' => 'My Quizzes',
                'details' => 'My Quizzes',
                'slug' => '/my-quizzes',
                'status' => 1,
                'is_static' => 1,
            ]);
        }


        $check7 = FrontPage::where('slug', '/my-classes')->first();
        if (!$check7) {
            DB::table('front_pages')->insert([
                'name' => 'My Classes',
                'title' => 'My Classes',
                'sub_title' => 'My Classes',
                'details' => 'My Classes',
                'slug' => '/my-classes',
                'status' => 1,
                'is_static' => 1,
            ]);
        }

        $check8 = FrontPage::where('slug', '/my-purchases')->first();
        if (!$check8) {
            DB::table('front_pages')->insert([
                'name' => 'My Purchases',
                'title' => 'My Purchases',
                'sub_title' => 'My Purchases',
                'details' => 'My Purchases',
                'slug' => '/my-purchases',
                'status' => 1,
                'is_static' => 1,
            ]);
        }

        $check9 = FrontPage::where('slug', '/my-profile')->first();
        if (!$check9) {
            DB::table('front_pages')->insert([
                'name' => 'My Profile',
                'title' => 'My Profile',
                'sub_title' => 'My Profile',
                'details' => 'My Profile',
                'slug' => '/my-profile',
                'status' => 1,
                'is_static' => 1,
            ]);
        }

        $check10 = FrontPage::where('slug', '/my-account')->first();
        if (!$check10) {
            DB::table('front_pages')->insert([
                'name' => 'My Account',
                'title' => 'My Account',
                'sub_title' => 'My Account',
                'details' => 'My Account',
                'slug' => '/my-account',
                'status' => 1,
                'is_static' => 1,
            ]);
        }

        $check10 = FrontPage::where('slug', '/deposit')->first();
        if (!$check10) {
            DB::table('front_pages')->insert([
                'name' => 'Deposit',
                'title' => 'Deposit',
                'sub_title' => 'Deposit',
                'details' => 'Deposit',
                'slug' => '/deposit',
                'status' => 1,
                'is_static' => 1,
            ]);
        }
        $check11 = FrontPage::where('slug', '/logged-in/devices')->first();
        if (!$check11) {
            DB::table('front_pages')->insert([
                'name' => 'Logged in devices',
                'title' => 'Logged in devices',
                'sub_title' => 'Logged in devices',
                'details' => 'Logged in devices',
                'slug' => '/logged-in/devices',
                'status' => 1,
                'is_static' => 1,
            ]);
        }

        $check12 = FrontPage::where('slug', '/referral')->first();
        if (!$check12) {
            DB::table('front_pages')->insert([
                'name' => 'Referral',
                'title' => 'Referral',
                'sub_title' => 'Referral',
                'details' => 'Referral',
                'slug' => '/referral',
                'status' => 1,
                'is_static' => 1,
            ]);
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
