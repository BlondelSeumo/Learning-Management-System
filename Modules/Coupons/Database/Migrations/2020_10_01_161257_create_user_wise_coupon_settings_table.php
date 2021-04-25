<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Coupons\Entities\UserWiseCouponSetting;

class CreateUserWiseCouponSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_wise_coupon_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id')->nullable()->default(3);
            $table->tinyInteger('type')->default(1)->nullable()->comment('1=Fixed Amount, 2=Percentage(%)');
            $table->tinyInteger('status')->default(1)->nullable()->comment('1=Enable, 2=Disable');
            $table->double('amount',16,2)->default(0.00)->nullable();
            $table->integer('max_limit')->default(1)->nullable();
            $table->timestamps();
        });

        $s = new UserWiseCouponSetting;
        $s->role_id      =   3;
        $s->amount       =   10;
        $s->max_limit    =   10;
        $s->save();



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_wise_coupon_settings');
    }
}
