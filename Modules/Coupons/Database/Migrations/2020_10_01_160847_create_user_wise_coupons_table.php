<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Modules\Coupons\Entities\UserWiseCoupon;
use Illuminate\Database\Migrations\Migration;

class CreateUserWiseCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_wise_coupons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invite_by')->nullable();
            $table->bigInteger('invite_accept_by')->nullable();
            $table->string('invite_code',50)->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('subcategory_id')->nullable();
            $table->bigInteger('course_id')->nullable();
            $table->double('bonus_amount')->nullable();
            $table->date('date')->nullable()->default(date('Y-m-d'));

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
        Schema::dropIfExists('user_wise_coupons');
    }
}
