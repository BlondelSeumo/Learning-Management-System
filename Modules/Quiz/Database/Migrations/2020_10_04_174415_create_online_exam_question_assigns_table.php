<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineExamQuestionAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_exam_question_assigns', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('online_exam_id')->nullable()->unsigned();
            $table->foreign('online_exam_id')->references('id')->on('online_quizzes')->onDelete('cascade');

            $table->integer('question_bank_id')->nullable()->unsigned();
            $table->foreign('question_bank_id')->references('id')->on('question_banks')->onDelete('cascade');

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
        Schema::dropIfExists('online_exam_question_assigns');
    }
}
