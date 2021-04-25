<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('status')->default(1);
            $table->integer('order');
            $table->timestamps();
        });

        $modules = [
            'AmazonS3',
            'BBB',
            'Sslcommerz',
        ];


        $i = 0;
        foreach ($modules as $module) {
            DB::table('modules')->insert([
                [
                    'name' => $module,
                    'order' => $i++,
                    'created_at' => now(),
                    'updated_at' => now(),

                ]
            ]);
        }

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
