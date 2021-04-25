<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\FrontendManage\Entities\FrontPage;

class CreateFrontPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('front_pages', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('title')->nullable();
            $table->text('sub_title')->nullable();
            $table->longText('details')->nullable();
            $table->string('slug')->unique();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('is_static')->default(1);
            $table->timestamps();
        });

        $page = new FrontPage();
        $page->name = 'Teacher directory';
        $page->title = 'Teacher directory';
        $page->slug = 'teacher-directory';
        $page->is_static = 0;
        $page->sub_title = 'Learn from industry experts';
        $page->details = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text
            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book';
        $page->save();


        $page = new FrontPage();
        $page->name = 'Unlimited access';
        $page->title = 'Unlimited access';
        $page->slug = 'feature';
        $page->is_static = 0;
        $page->sub_title = 'Learn on your schedule';
        $page->details = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text
            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book';
        $page->save();


    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('front_pages');
    }
}
