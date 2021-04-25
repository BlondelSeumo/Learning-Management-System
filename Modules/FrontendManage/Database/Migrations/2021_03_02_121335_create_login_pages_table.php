<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_pages', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('banner');
            $table->text('slogans1');
            $table->text('slogans2');
            $table->text('slogans3');
            $table->timestamps();
        });
        $loginPage = new \Modules\FrontendManage\Entities\LoginPage();
        $loginPage->title = 'Welcome to Infix Learning Management System';
        $loginPage->banner = 'public/frontend/infixlmstheme/img/banner/global.png';
        $loginPage->slogans1 = 'Excellence.';
        $loginPage->slogans2 = 'Community.';
        $loginPage->slogans3 = 'Diversity.';
        $loginPage->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_pages');
    }
}
