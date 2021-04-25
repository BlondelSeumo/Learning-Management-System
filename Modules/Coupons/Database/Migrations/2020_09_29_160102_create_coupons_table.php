<?php

use Modules\Coupons\Entities\Coupon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('coupons');
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable()->default(1);
            $table->string('title')->nullable();
            $table->string('code')->nullable();
            $table->boolean('status')->default(1);
            $table->float('value')->nullable()->default(0);
            $table->boolean('type')->default(1)->comment('1=Fixed Amount, 0=Percentage');
            $table->float('min_purchase')->nullable()->default(0);
            $table->float('max_discount')->nullable()->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('category')->default(1)->comment('1=Common, 2=Single, 3=Personalized');
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('subcategory_id')->unsigned()->nullable();
            $table->integer('course_id')->unsigned()->nullable();
            $table->integer('coupon_user_id')->unsigned()->nullable();
            $table->timestamps();
        });

        for ($j = 1; $j <= 3; $j++) {
            for ($i = 1; $i <= 3; $i++) {
                $s = new Coupon;
                $s->user_id = $i;
                $s->title = 'Coupon Asia 0' . rand() % 10;
                $s->code = 'XT9809' . $i;
                $s->value = 10;
                $s->min_purchase = 40 + rand() % 10;
                $s->max_discount = 20 + rand() % 10;
                $s->start_date = date('Y-m-d');
                $s->end_date = date('Y-m-d', strtotime(date('Y-m-d') . " +7 days"));
                $s->category = $j;
                $s->category_id = 1;
                $s->subcategory_id = 1;
                $s->course_id = 1;
                $s->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
