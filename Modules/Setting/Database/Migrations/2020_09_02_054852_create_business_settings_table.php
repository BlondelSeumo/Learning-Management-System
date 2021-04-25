<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Setting\Model\BusinessSettings;

class CreateBusinessSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_settings', function (Blueprint $table) {
            $table->id();
            $table->string("type", 200);
            $table->boolean("status")->default(0);
            $table->timestamps();
        });

        DB::table('business_settings')->insert([
            [
                'type' => 'email_verification',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),

            ],

            [
                'type' => 'language_translation',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_settings');
    }
}
