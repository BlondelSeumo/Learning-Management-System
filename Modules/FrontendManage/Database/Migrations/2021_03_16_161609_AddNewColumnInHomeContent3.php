<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddNewColumnInHomeContent3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_contents', function ($table) {
            if (!Schema::hasColumn('home_contents', 'show_key_feature')) {
                $table->boolean('show_key_feature')->default(true);
            }
        });

        Schema::table('home_contents', function ($table) {
            if (!Schema::hasColumn('home_contents', 'key_feature_title1')) {
                $table->string('key_feature_title1')->default('50K+ Online Courses');
            }
        });


        Schema::table('home_contents', function ($table) {
            if (!Schema::hasColumn('home_contents', 'key_feature_subtitle1')) {
                $table->string('key_feature_subtitle1')->default('Enjoy lifetime access to courses');
            }
        });

        Schema::table('home_contents', function ($table) {
            if (!Schema::hasColumn('home_contents', 'key_feature_logo1')) {
                $table->string('key_feature_logo1')->default('public/frontend/infixlmstheme/img/svg/course_1.svg');
            }
        });

        Schema::table('home_contents', function ($table) {
            if (!Schema::hasColumn('home_contents', 'key_feature_link1')) {
                $table->string('key_feature_link1')->nullable();
            }
        });


        Schema::table('home_contents', function ($table) {
            if (!Schema::hasColumn('home_contents', 'key_feature_title2')) {
                $table->string('key_feature_title2')->default('Teacher directory');
            }
        });


        Schema::table('home_contents', function ($table) {
            if (!Schema::hasColumn('home_contents', 'key_feature_subtitle2')) {
                $table->string('key_feature_subtitle2')->default('Learn from industry experts');
            }
        });

        Schema::table('home_contents', function ($table) {
            if (!Schema::hasColumn('home_contents', 'key_feature_logo2')) {
                $table->string('key_feature_logo2')->default('public/frontend/infixlmstheme/img/svg/course_2.svg');
            }
        });

        Schema::table('home_contents', function ($table) {
            if (!Schema::hasColumn('home_contents', 'key_feature_link2')) {
                $table->string('key_feature_link2')->nullable();
            }
        });

        Schema::table('home_contents', function ($table) {
            if (!Schema::hasColumn('home_contents', 'key_feature_title3')) {
                $table->string('key_feature_title3')->default('Unlimited access');
            }
        });


        Schema::table('home_contents', function ($table) {
            if (!Schema::hasColumn('home_contents', 'key_feature_subtitle3')) {
                $table->string('key_feature_subtitle3')->default('Learn on your schedule');
            }
        });

        Schema::table('home_contents', function ($table) {
            if (!Schema::hasColumn('home_contents', 'key_feature_logo3')) {
                $table->string('key_feature_logo3')->default('public/frontend/infixlmstheme/img/svg/course_3.svg');
            }
        });

        Schema::table('home_contents', function ($table) {
            if (!Schema::hasColumn('home_contents', 'key_feature_link3')) {
                $table->string('key_feature_link3')->nullable();
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
