<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('subscribers', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('user_id');
//            $table->integer('package_id');
//            $table->float('price');
//            $table->dateTime('valid');
//            $table->boolean('status')->default(1);
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('subscribers');
    }
}
