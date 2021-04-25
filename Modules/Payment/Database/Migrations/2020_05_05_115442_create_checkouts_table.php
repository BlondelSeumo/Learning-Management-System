<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tracking');
            $table->integer('user_id');
            $table->unsignedBigInteger('billing_detail_id')->nullable();
            $table->integer('package_id')->nullable();
            $table->integer('coupon_id')->nullable();
            $table->float('discount')->default(0.00);
            $table->float('purchase_price');
            $table->float('price');
            $table->boolean('status')->default(0);
            $table->string('payment_method')->nullable();
            $table->longText('response')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('checkouts');
    }
}
