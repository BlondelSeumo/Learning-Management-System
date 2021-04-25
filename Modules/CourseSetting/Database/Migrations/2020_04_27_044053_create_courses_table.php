<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->integer('quiz_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('lang_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('duration')->nullable();
            $table->string('image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->float('price')->default(0);
            $table->float('discount_price')->nullable();
            $table->boolean('publish')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('level')->unsigned()->nullable()->default(4);
            $table->string('trailer_link')->nullable();
            $table->string('host')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->text('about')->nullable();
            $table->float('special_commission')->nullable();
            $table->integer('total_enrolled')->default(0);
            $table->float('reveune')->default(0.00);
            $table->float('reveiw')->default(0.00);
            $table->integer('type')->default(1)->comment = '1=Course, 2=Quiz';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
