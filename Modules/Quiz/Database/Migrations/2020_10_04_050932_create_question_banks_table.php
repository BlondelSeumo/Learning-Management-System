<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 2)->comment('M for multi ans, T for trueFalse, F for fill in the blanks');
            $table->text('question')->nullable();
            $table->integer('marks')->nullable();
            $table->string('trueFalse', 1)->nullable()->comment('F = false, T = true ');
            $table->text('suitable_words')->nullable();
            $table->string('number_of_option', 2)->nullable();
            $table->integer('q_group_id')->nullable()->unsigned();
            $table->integer('category_id')->nullable()->unsigned();
            $table->integer('sub_category_id')->nullable()->unsigned();
            $table->tinyInteger('active_status')->default(1);
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
        Schema::dropIfExists('question_banks');
    }
}
