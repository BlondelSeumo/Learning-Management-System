<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('method');
            $table->string('type')->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->tinyInteger('module_status')->default(0);
            $table->text('logo')->nullable();
            $table->integer('created_by')->nullable()->default(1)->unsigned();
            $table->integer('updated_by')->nullable()->default(1)->unsigned();
            $table->timestamps();
        });


        DB::table('payment_methods')->insert([
//            [
//                'id' => 1,
//                'method' => 'Sslcommerz',
//                'type' => 'System',
//                'active_status' => 1,
//                'module_status' => 1,
//                'logo' => 'public/demo/gateway/ssl.png',
//                'created_at' => now(),
//                'updated_at' => now(),
//            ],
            [
                'id' => 2,
                'method' => 'PayPal',
                'type' => 'System',
                'active_status' => 1,
                'module_status' => 1,
                'logo' => 'public/demo/gateway/paypal.png',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'id' => 3,
                'method' => 'Stripe',
                'type' => 'System',
                'active_status' => 1,
                'module_status' => 1,
                'logo' => 'public/demo/gateway/stripe.png',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'id' => 4,
                'method' => 'PayStack',
                'type' => 'System',
                'active_status' => 1,
                'module_status' => 1,
                'logo' => 'public/demo/gateway/paystack.png',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'id' => 5,
                'method' => 'RazorPay',
                'type' => 'System',
                'active_status' => 1,
                'module_status' => 1,
                'logo' => 'public/demo/gateway/razorpay.png',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'id' => 6,
                'method' => 'PayTM',
                'type' => 'System',
                'active_status' => 1,
                'module_status' => 1,
                'logo' => 'public/demo/gateway/paytm.png',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'id' => 7,
                'method' => 'Bank Payment',
                'type' => 'System',
                'active_status' => 1,
                'module_status' => 1,
                'logo' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 8,
                'method' => 'Offline Payment',
                'type' => 'System',
                'active_status' => 1,
                'module_status' => 1,
                'logo' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'method' => 'Wallet',
                'type' => 'System',
                'active_status' => 1,
                'module_status' => 1,
                'logo' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
}
