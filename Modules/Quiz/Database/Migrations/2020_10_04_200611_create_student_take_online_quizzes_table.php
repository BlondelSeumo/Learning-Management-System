<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTakeOnlineQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_take_online_quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status')->default(0)->comment('0=Not Yet, 1 = already submitted, 2 = got marks');
            $table->integer('total_marks')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();

            $table->integer('student_id')->nullable()->unsigned();
            // $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('online_exam_id')->nullable()->unsigned();
            $table->foreign('online_exam_id')->references('id')->on('online_quizzes')->onDelete('cascade');

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
        Schema::dropIfExists('student_take_online_quizzes');
    }
}
