<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\SystemSetting\Entities\FrontendSetting;

class CreateFrontendSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frontend_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('section');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('btn_name')->nullable();
            $table->string('btn_link')->nullable();
            $table->string('url')->nullable();
            $table->string('icon')->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
            $table->timestamps();
        });

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
            'title' => 'Teacher directory',
            'url' => 'pages/1/teacher-directory',
            'description' => 'Learn from industry experts',
            'icon' => 'fas fa-chalkboard-teacher'
        ]);

        FrontendSetting::create([
            'section' => 'course_detail_right',
            'title' => 'Unlimited access',
            'url' => 'pages/2/features',
            'description' => 'Learn on your schedule',
            'icon' => 'fas fa-universal-access'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frontend_settings');
    }
}
