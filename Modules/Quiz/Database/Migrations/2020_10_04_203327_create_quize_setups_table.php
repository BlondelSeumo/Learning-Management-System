<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Quiz\Entities\QuizeSetup;

class CreateQuizeSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quize_setups', function (Blueprint $table) {
            $table->id();
            $table->string('random_question')->nullable();
//            $table->double('mark_per_question')->nullable();
            $table->string('set_per_question_time')->nullable();
            $table->double('time_per_question')->nullable();
            $table->double('time_total_question')->nullable();
            $table->string('question_review')->nullable();
            $table->string('show_result_each_submit')->nullable();
            $table->boolean('multiple_attend')->default(false);


            $table->timestamps();
        });

        $setup = new QuizeSetup();
        $setup->random_question = 0;
        // $setup->mark_per_question=1;
        $setup->set_per_question_time = 1;
        $setup->question_review = 1;
        $setup->time_per_question = 1;
        $setup->show_result_each_submit = 1;
        $setup->multiple_attend = 1;
        $setup->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quize_setups');
    }
}
