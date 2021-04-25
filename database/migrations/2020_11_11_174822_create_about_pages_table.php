<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAboutPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            $table->string('who_we_are')->nullable();
            $table->string('banner_title')->nullable();


            $table->string('story_title')->nullable();
            $table->longText('story_description')->nullable();

            $table->string('teacher_title')->nullable();
            $table->longText('teacher_details')->nullable();
            $table->string('course_title')->nullable();
            $table->longText('course_details')->nullable();
            $table->string('student_title')->nullable();
            $table->longText('student_details')->nullable();
            $table->timestamps();
        });
        DB::table('about_pages')->insert([
            'id' => 1,
            'who_we_are' => 'Improving lives through Learning. We are always Inspired by the world and people us. Celebrating e-Learning excellence in Personal.',
            'banner_title' => 'We are here to meet your demand and teach the most beneficial way for you in Personal.',
            'story_title' => 'Build your own library for your career and personal growth.',
            'story_description' => 'Our goal is to learn the next generation of creative professionals for a future in any industry. We offer course in most demanded industries. Whether begin to your journey on our courses website or choose the flexibility of video learning our courses are designed to help you along your path.',
            'teacher_title' => 'Most Involved Teachers',
            'teacher_details' => 'Key features are the ability to develop relationships with their students, patient, caring and kind knowledge offer learner engaging students of their.',
            'student_title' => 'Large Selection of Courses',
            'student_details' => 'Key features are the ability to develop relationships with their students, patient, caring and kind knowledge offer learner engaging students of their.',
            'course_title' => 'High-Quality Course',
            'course_details' => 'Key features are the ability to develop relationships with their students, patient, caring and kind knowledge offer learner engaging students of their.',
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('about_pages');
    }
}
