<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\SystemSetting\Entities\FooterCategory;

class CreateFooterCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('placeholder')->nullable();

            $table->timestamps();
        });

        FooterCategory::create([
            'title' => 'Company',
        ]);
        FooterCategory::create([
            'title' => 'Products',
        ]);
        FooterCategory::create([
            'title' => 'Support',
        ]);
        FooterCategory::create([
            'title' => 'Stay Up to Date',
            'description' => 'By giving us your email, you agree to our Terms of Service and Privacy Policy.',
            'placeholder' => 'Enter Your Email',
        ]);
        FooterCategory::create([
            'title' => 'Bottom Footer Part',
            'description' => '<p>@InfixLMS - Ultimate Learning Management All Rights Reserved to - <a href="https://codecanyon.net/user/codethemes/portfolio" rel="noopener noreferrer" target="_blank" style="color: rgb(254, 23, 36);">CodeThemes</a></p>',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('footer_categories');
    }
}
