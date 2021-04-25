<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddNewColumnInHomeContent2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_contents', function ($table) {
            if (!Schema::hasColumn('home_contents', 'slider_banner')) {
                $table->string('slider_banner')->default('public/frontend/infixlmstheme/img/banner/banner.jpg');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
