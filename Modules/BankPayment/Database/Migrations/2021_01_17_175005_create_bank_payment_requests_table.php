<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankPaymentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_payment_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->text('bank_name')->nullable();
            $table->text('account_holder')->nullable();
            $table->text('branch_name')->nullable();
            $table->text('amount')->nullable();
            $table->text('account_number')->nullable();
            $table->text('image')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('bank_payment_requests');
    }
}
