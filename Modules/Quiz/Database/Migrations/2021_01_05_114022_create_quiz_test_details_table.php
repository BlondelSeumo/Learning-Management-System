<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizTestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_test_details', function (Blueprint $table) {
            $table->id();
            $table->integer('quiz_test_id');
            $table->integer('qus_id');
            $table->integer('ans_id');
            $table->integer('status')->default(1)->comment('1=true;0=false');
            $table->integer('mark')->default(0);
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
        Schema::dropIfExists('quiz_test_details');
    }
}
