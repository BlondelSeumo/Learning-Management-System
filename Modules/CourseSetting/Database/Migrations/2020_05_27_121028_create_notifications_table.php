<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('author_id');
            $table->unsignedInteger('message_id')->nullable();
            $table->unsignedInteger('course_comment_id')->nullable();
            $table->unsignedInteger('course_review_id')->nullable();
            $table->unsignedInteger('course_enrolled_id')->nullable();
            $table->boolean('status')->default(0)->nullable();

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
        Schema::dropIfExists('notifications');
    }
}
