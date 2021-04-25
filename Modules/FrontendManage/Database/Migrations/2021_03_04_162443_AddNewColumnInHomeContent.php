<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddNewColumnInHomeContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_contents', function ($table) {
            if (!Schema::hasColumn('home_contents', 'category_title')) {
                $table->string('category_title')->default('Find videos courses on almost any topic to build career.');
            }

            if (!Schema::hasColumn('home_contents', 'category_sub_title')) {
                $table->string('category_sub_title')->default('Enjoy lifetime access to courses on our website and app.');
            }

            if (!Schema::hasColumn('home_contents', 'instructor_banner')) {
                $table->string('instructor_banner')->default('public/frontend/infixlmstheme/img/banner/cta_bg.jpg');
            }

            if (!Schema::hasColumn('home_contents', 'instructor_title')) {
                $table->string('instructor_title')->default('Limitless learning and more possibilities');
            }
            if (!Schema::hasColumn('home_contents', 'instructor_sub_title')) {
                $table->string('instructor_sub_title')->default('Choose from over 100,000 online video courses with new');
            }
            if (!Schema::hasColumn('home_contents', 'course_title')) {
                $table->string('course_title')->default('Top Online Courses');
            }
            if (!Schema::hasColumn('home_contents', 'course_sub_title')) {
                $table->string('course_sub_title')->default('The world’s largest selection of courses choose from 130,000 online video courses with new additions published every month');
            }

            if (!Schema::hasColumn('home_contents', 'best_category_banner')) {
                $table->string('best_category_banner')->default('public/frontend/infixlmstheme/img/banner/backage_bg.jpg');
            }
            if (!Schema::hasColumn('home_contents', 'best_category_title')) {
                $table->string('best_category_title')->default('Online Learning from the World’s best categories');
            }

            if (!Schema::hasColumn('home_contents', 'best_category_sub_title')) {
                $table->string('best_category_sub_title')->default('Choose from over 100,000 online video courses with new additions published every month');
            }

            if (!Schema::hasColumn('home_contents', 'quiz_title')) {
                $table->string('quiz_title')->default('Explore popular Quizzes');
            }
            if (!Schema::hasColumn('home_contents', 'testimonial_sub_title')) {
                $table->string('testimonial_sub_title')->default('The world’s largest selection of courses choose from 130,000 online video courses with new additions published every month');
            }

            if (!Schema::hasColumn('home_contents', 'article_title')) {
                $table->string('article_title')->default('Articles & News');
            }
            if (!Schema::hasColumn('home_contents', 'article_sub_title')) {
                $table->string('article_sub_title')->default('The world’s largest selection of courses choose from 130,000 online video courses with new additions published every month');
            }

            if (!Schema::hasColumn('home_contents', 'subscribe_logo')) {
                $table->string('subscribe_logo')->default('public/frontend/infixlmstheme/img/book.png');
            }

            if (!Schema::hasColumn('home_contents', 'subscribe_title')) {
                $table->string('subscribe_title')->default('Keep up to date — Get e-mail updates');
            }
            if (!Schema::hasColumn('home_contents', 'subscribe_sub_title')) {
                $table->string('subscribe_sub_title')->default('Stay tuned for the latest company news.');
            }
//---------------------
            if (!Schema::hasColumn('home_contents', 'course_page_title')) {
                $table->string('course_page_title')->default('Courses');
            }

            if (!Schema::hasColumn('home_contents', 'course_page_sub_title')) {
                $table->string('course_page_sub_title')->default('Join the Millions for better learning.');
            }

            if (!Schema::hasColumn('home_contents', 'course_page_banner')) {
                $table->string('course_page_banner')->default('public/frontend/infixlmstheme/img/banner/bradcam_bg_1.jpg');
            }

//---------------------
            if (!Schema::hasColumn('home_contents', 'class_page_title')) {
                $table->string('class_page_title')->default('Classes');
            }

            if (!Schema::hasColumn('home_contents', 'class_page_sub_title')) {
                $table->string('class_page_sub_title')->default('Join the Millions for better learning.');
            }

            if (!Schema::hasColumn('home_contents', 'class_page_banner')) {
                $table->string('class_page_banner')->default('public/frontend/infixlmstheme/img/banner/bradcam_bg_2.jpg');
            }

//---------------------
            if (!Schema::hasColumn('home_contents', 'quiz_page_title')) {
                $table->string('quiz_page_title')->default('Quizzes');
            }

            if (!Schema::hasColumn('home_contents', 'quiz_page_sub_title')) {
                $table->string('quiz_page_sub_title')->default('Join the Millions for better learning.');
            }

            if (!Schema::hasColumn('home_contents', 'quiz_page_banner')) {
                $table->string('quiz_page_banner')->default('public/frontend/infixlmstheme/img/banner/bradcam_bg_3.jpg');
            }

            //---------------------
            if (!Schema::hasColumn('home_contents', 'instructor_page_title')) {
                $table->string('instructor_page_title')->default('Instructor');
            }

            if (!Schema::hasColumn('home_contents', 'instructor_page_sub_title')) {
                $table->string('instructor_page_sub_title')->default('Start your education Career with us.');
            }

            if (!Schema::hasColumn('home_contents', 'instructor_page_banner')) {
                $table->string('instructor_page_banner')->default('public/frontend/infixlmstheme/img/banner/bradcam_bg_4.jpg');
            }

            //---------------------
            if (!Schema::hasColumn('home_contents', 'contact_page_title')) {
                $table->string('contact_page_title')->default('Contact Us');
            }

            if (!Schema::hasColumn('home_contents', 'contact_sub_title')) {
                $table->string('contact_sub_title')->default('We’re here with you every step way!');
            }

            if (!Schema::hasColumn('home_contents', 'contact_page_banner')) {
                $table->string('contact_page_banner')->default('public/frontend/infixlmstheme/img/banner/bradcam_bg_5.jpg');
            }
            //---------------------
            if (!Schema::hasColumn('home_contents', 'about_page_title')) {
                $table->string('about_page_title')->default('About Company');
            }

            if (!Schema::hasColumn('home_contents', 'about_sub_title')) {
                $table->string('about_sub_title')->default('The leading global marketplace.');
            }

            if (!Schema::hasColumn('home_contents', 'about_page_banner')) {
                $table->string('about_page_banner')->default('public/frontend/infixlmstheme/img/banner/bradcam_bg_6.jpg');
            }


            if (!Schema::hasColumn('home_contents', 'become_instructor_title')) {
                $table->string('become_instructor_title')->default('Become a Instructor.');
            }

            if (!Schema::hasColumn('home_contents', 'become_instructor_sub_title')) {
                $table->string('become_instructor_sub_title')->default('Teach what you love. Corrector gives you the tools to create a course .');
            }


            if (!Schema::hasColumn('home_contents', 'become_instructor_logo')) {
                $table->string('become_instructor_logo')->default('public/frontend/infixlmstheme/img/services/1.png');
            }


        });
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
