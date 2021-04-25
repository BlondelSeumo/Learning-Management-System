<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionBankMuOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_bank_mu_options', function (Blueprint $table) {
             $table->increments('id');
            $table->string('title')->nullable();
            $table->tinyInteger('status')->nullable()->comment('0 = false, 1 = correct');
            $table->tinyInteger('active_status')->default(1);
            $table->timestamps();


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
        Schema::dropIfExists('question_bank_mu_options');
    }
}
