<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseEnrolledsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_enrolleds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tracking')->default(1)->nullable();
            $table->integer('user_id');
            $table->integer('course_id');
            $table->float('purchase_price');
            $table->string('coupon')->nullable();
            $table->float('discount_amount')->default(0);
            $table->boolean('status')->default(1);
            $table->float('reveune')->default(0.00);
            $table->text('reason')->nullable();
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
        Schema::dropIfExists('course_enrolleds');
    }
}
