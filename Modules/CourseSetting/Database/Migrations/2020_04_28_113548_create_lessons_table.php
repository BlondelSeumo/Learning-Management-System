<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned();
            $table->integer('chapter_id')->unsigned();
            $table->integer('quiz_id')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('video_url')->nullable();
            $table->string('host')->nullable();
            $table->string('duration')->nullable();
            $table->boolean('is_lock')->default(1);
            $table->boolean('is_quiz')->default(0);
            $table->date('unlock_date')->nullable();
            $table->integer('unlock_days')->nullable();
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
        Schema::dropIfExists('lessons');
    }
}
