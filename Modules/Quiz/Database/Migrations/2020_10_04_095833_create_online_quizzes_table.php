<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_quizzes', function (Blueprint $table) {
             $table->increments('id');
            $table->string('title')->nullable();
//            $table->date('date')->nullable()->nullable();
//            $table->string("start_time", 200)->nullable();
//            $table->string("end_time", 200)->nullable();
//            $table->string('end_date_time')->nullable();
            $table->integer("percentage")->nullable();
            $table->text("instruction")->nullable();
            $table->tinyInteger("status")->nullable()->comment('0 = Pending 1 Published');
            $table->tinyInteger("is_taken")->default(0)->nullable();
            $table->tinyInteger("is_closed")->default(0)->nullable();
            $table->tinyInteger("is_waiting")->default(0)->nullable();
            $table->tinyInteger("is_running")->default(0)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();

            $table->integer('category_id')->nullable()->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->integer('sub_category_id')->nullable()->unsigned();
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');

            $table->integer('course_id')->nullable()->unsigned();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            $table->integer('created_by')->nullable()->default(1)->unsigned();

            $table->integer('updated_by')->nullable()->default(1)->unsigned();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('online_quizzes');
    }
}
