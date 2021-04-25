<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddAboutPageColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_pages', function ($table) {
            if (!Schema::hasColumn('about_pages', 'image1')) {
                $table->string('image1')->default('public/frontend/infixlmstheme/img/about/1.jpg');
            }

            if (!Schema::hasColumn('about_pages', 'image2')) {
                $table->string('image2')->default('public/frontend/infixlmstheme/img/about/2.jpg');
            }

            if (!Schema::hasColumn('about_pages', 'image3')) {
                $table->string('image3')->default('public/frontend/infixlmstheme/img/about/3.jpg');
            }
            if (!Schema::hasColumn('about_pages', 'image4')) {
                $table->string('image4')->default('public/frontend/infixlmstheme/img/about/counter_bg.png');
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

    }
}
